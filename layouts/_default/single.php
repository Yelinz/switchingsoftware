{{ define "php-header" -}}
<?php
    /* Load HazzelForm library */
    $hugo_path = '{{ .File.Dir }}';
    $hazzel_path = substring(__DIR__, 0, strlen(__DIR__) - strlen($hugo_path)) . "/submodules/HazzelForms/src/HazzelForms/HazzelForm.php";
    require_once $hazzel_path;
?>
{{ end }}

{{ define "main" }}
    {{ with .Content }}
        <section id="intro">
            {{ . }}
        </section>
    {{ end }}

    <?php
        {{ with .Params.fields }}
            $form = new HazzelForms\HazzelForm();
            $honeypots = ['Fullname', 'Phone', 'Mail', 'Subject', 'Website'];
            $counter = 1;

            {{ range . }}
                $form->addField('{{ .name }}', '{{ .type }}', ['placeholder' => '{{ .placeholder | default .name }}']);
                $form->addField($honeypots[$counter++], 'honeypot');
            {{ end }}


            if ($form->validate()) {
                $to = getenv('SWISO_CONTACT_EMAIL');
                $from = getenv('SWISO_SENDER_EMAIL');
                $form->sendMail($to, $from);
            }

            $form->renderAll();
        {{ end }}
    ?>
{{ end }}