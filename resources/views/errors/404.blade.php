<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="04c3bf7c897cb0df" />
        <meta name="google-site-verification" content="g7c3etR_RSTclA04HGiIwvCuIh8XugsxGr_MmYaWl4M" />
        <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="preload" href="../img/logo-icon.webp" as="image" type="image/webp">
        <link rel="preload" href="../assets/metrica.js" as="script" />
        <script defer src="../assets/player.js"></script>
        <!-- Scripts -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
</head>
<body class="bg-slate-100">
@inertia
</body>
</html>
