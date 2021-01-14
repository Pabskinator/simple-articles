<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Article</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="antialiased">
    <div id="app" class="container-fluid p-3">
        <example-component></example-component>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
