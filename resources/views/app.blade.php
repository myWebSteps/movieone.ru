<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="04c3bf7c897cb0df" />
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <!-- Scripts -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body id="page-top">
        @inertia
    </body>

        <script src="https://kinobox.tv/kinobox.min.js"></script>

    <noscript><div><img src="https://mc.yandex.ru/watch/94438576" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

</html>
