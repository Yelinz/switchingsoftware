<?php
/**
 * Deploy script for staging and production site of switching.software
 *
 * @category None
 * @package  None
 * @author   switching.software <info@switching.software>
 * @license  CC-BY-SA 4.0
 * @link     https://switching.software
 */

$secret = getenv('CODEBERG_DEPLOY_SECRET');
$hugo = 'hugo';
$source_dir = '/home/swiso/src/website/';
$public_dir = '/home/swiso/www/';

// check secret is set
if (empty($secret)) {
    error('FAILED - CODEBERG_DEPLOY_SECRET not set');
}

// check for POST request
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    error('not POST - '. $_SERVER['REQUEST_METHOD']);
}

// get content type
$content_type = isset($_SERVER['CONTENT_TYPE']) ? strtolower(trim($_SERVER['CONTENT_TYPE'])) : '';

if ($content_type != 'application/json') {
    error('not application/json - '. $content_type);
}

// get payload
$payload = trim(file_get_contents("php://input"));

if (empty($payload)) {
    error('no payload');
}

// get header signature
if (!isset($_SERVER['HTTP_X_GITEA_SIGNATURE'])) {
    error('header signature missing');
}

$header_signature = $_SERVER['HTTP_X_GITEA_SIGNATURE'];

// check payload signature against header signature
$payload_signature = hash_hmac('sha256', $payload, $secret, false);

if ($header_signature != $payload_signature) {
    error('payload signature');
}

// convert json to array
$data = json_decode($payload);

if (json_last_error() !== JSON_ERROR_NONE) {
    error('json decode failed - '. json_last_error());
}

// determine changed branch
if (!isset($data->ref)) {
    error('no target branch');
}

if (substr($data->ref, 0, 11) !== "refs/heads/") {
    error('couldn\'t determine branch - '. $data->ref);
}

$branch = substr($data->ref, 11);
$subdomain = ($branch == "main") ? '' : $branch . '.';

if ($branch !== "main" && $branch !== "develop") {
    error('unknown branch - '. $branch);
}

// collect commit messages
$commit_message = '';
foreach ($data->commits as $commit) {
    $commit_message .= ' ' . $commit->message;
}

if (empty($commit_message)) {
    error('no commits');
}

// Do a git checkout
$output = array();
$return = 0;

exec('cd ' . $source_dir . '&& git fetch --all --prune && git reset --hard origin/' . $branch, $output, $return);
if ($return != 0) {
    error('git fetch/reset failed');
}

// Run Hugo for switching.software
exec('cd ' . $source_dir . '&& ' . $hugo . ' -b https://' . $subdomain . 'switching.software -d ' . $public_dir . 'switching-software/' . $branch . ' --cleanDestinationDir', $output, $return);
if ($return != 0 && $return != 255) {
    error('hugo build failed (switching.software)');
}

// Run Hugo for swiso.org
exec('cd ' . $source_dir . '&& ' . $hugo . ' -b https://' . $subdomain . 'swiso.org -d ' . $public_dir . 'swiso-org/' . $branch . ' --cleanDestinationDir', $output, $return);
if ($return != 0 && $return != 255) {
    error('hugo build failed (swiso.org)');
}

// Update deploy script
if ($branch == "develop") {
    exec('cp ' . $source_dir . '/deploy.php ' . getcwd() . '/deploy.php', $output, $return);
    if ($return != 0 && $return != 255) {
        error('update of deploy script failed');
    }
}

// Log the deployment
file_put_contents(
    $public_dir . 'deploy.txt',
    date('Y-m-d H:i:s') . " on " .  $branch . ": " . $commit_message,
    FILE_APPEND
);

/**
 * Print error message to log and return error code
 *
 * @param  String $text the error message
 * @return void
 */
function error($text)
{
    // log error message
    error_log('deploy failed - ' . $text);
    file_put_contents(
        $public_dir . 'deploy.txt',
        date('Y-m-d H:i:s') . " error: " . $text,
        FILE_APPEND
    );

    // return error message to sender
    http_response_code(404);
    echo($text);
    exit(4);
};