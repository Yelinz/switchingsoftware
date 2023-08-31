{{ block "php-header" . }}
{{ end }}

<!DOCTYPE html>
<html lang="{{ .Site.Language.Lang }}">
{{ partial "head.html" . }}

{{ partial "meta.html" . }}

<body id="top" class="type-{{ .Type }} m-0 p-0
    {{- with .File }} slug-{{ lower .ContentBaseName }} {{- end }}">
    <div id="container">
        {{ partial "header.html" . }}

        <main id="content" class="container grid-md">
            {{ partial "hero.html" . }}

            {{- block "main" . }}
            {{ end }}
        </main>

        {{ partial "footer.html" . }}
    </div>
</body>
</html>