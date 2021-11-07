<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link Shortener</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
</head>

<body class="h-full">
    <div id="app" class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <main-form />
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
