<!DOCTYPE html>
<html class="h-full" data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="all" />
</head>

<body class="h-full relative flex p-4">

    <div id="app" class="w-full">
        <nback/>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
