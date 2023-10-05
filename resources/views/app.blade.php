<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>

        <script src="https://kinobox.tv/kinobox.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vueperslides"></script>
    <link href="https://unpkg.com/vueperslides/dist/vueperslides.css" rel="stylesheet">

</html>
