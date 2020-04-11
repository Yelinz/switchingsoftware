{{ define "php-header" -}}
<?php
    /* Load HazzelForm library */
    $hugo_path = '{{ .File.Dir }}';
    $hazzel_path = substr(__DIR__, 0, strlen(__DIR__) - strlen($hugo_path)) . "/submodules/HazzelForms/src/HazzelForms/HazzelForm.php";
    require_once $hazzel_path;

    /* Init form and honeypot fields */
    {{- with .Params.fields }}
        $form = new HazzelForms\HazzelForm();
        $honeypots = ['Fullname', 'Phone', 'Mail', 'Subject', 'Website'];
        $counter = 1;

    /* Create form fields */
        {{- range . }}
            $form->addField('{{ .name }}', '{{ .type }}', [
                'label'       => '{{ .name }}',
                'placeholder' => '{{ .placeholder | default .name }}',
                'classlist'   => 'form-input' ]);
            $form->addField($honeypots[$counter++], 'honeypot', [
                'classlist'   => 'd-none',
                'inline-css'  => false ]);
        {{- end }}

    /* Validate and send form */
        if ($form->validate()) {
            $to = getenv('SWISO_CONTACT_EMAIL');
            $from = getenv('SWISO_SENDER_EMAIL');
            $form->sendMail($to, $from);
        }
    {{- end }}
?>
{{ end }}

{{ define "main" }}
    {{- with .Content }}
        <section id="intro">
            {{ . }}
        </section>
    {{- end }}

    {{- with .Params.fields }}
    <?php
        ob_start();

        $form->openForm();
        $counter = 1;
        {{- range . }}
            $form->renderField('{{ .name }}');
            $form->renderField($honeypots[$counter++]);
        {{- end }}
        $form->renderSubmitErrors();
        $form->renderSubmit();
        $form->closeForm();

        $content = ob_get_clean();
        $content = str_replace( 'field-wrap', 'form-group', $content );
        $content = str_replace( 'label', 'form-label', $content );
        $content = str_replace( 'type="submit"', 'class="btn btn-primary p-centered" type="submit"', $content );
        echo $content;
    ?>
    {{- end }}
{{ end }}