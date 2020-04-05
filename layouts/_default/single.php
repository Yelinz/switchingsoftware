{{ define "php-header" -}}
<?php
    /* Load HazzelForm library */
    $hugo_path = '{{ .File.Dir }}';
    $hazzel_path = substr(__DIR__, 0, strlen(__DIR__) - strlen($hugo_path)) . "/submodules/HazzelForms/src/HazzelForms/HazzelForm.php";
    require_once $hazzel_path;

    {{ with .Params.fields }}
        $form = new HazzelForms\HazzelForm();
        $honeypots = ['Fullname', 'Phone', 'Mail', 'Subject', 'Website'];
        $counter = 1;

        {{ range . }}
            $form->addField('{{ .name }}', '{{ .type }}', [
                'label'       => '{{ .name }}',
                'placeholder' => '{{ .placeholder | default .name }}',
                'classlist'   => 'form-input' ]);
            $form->addField($honeypots[$counter++], 'honeypot');
        {{ end }}

        if ($form->validate()) {
            $to = getenv('SWISO_CONTACT_EMAIL');
            $from = getenv('SWISO_SENDER_EMAIL');
            $form->sendMail($to, $from);
        }
    {{ end }}
?>
{{ end }}

{{ define "main" }}
    {{ with .Content }}
        <section id="intro">
            {{ . }}
        </section>
    {{ end }}

    <?php $form->renderAll(); ?>
{{ end }}