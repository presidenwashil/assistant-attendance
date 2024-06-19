<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        @livewireStyles
    </head>
    <body>
        {{ $slot }}

        @livewireScripts
    </body>
</html>
