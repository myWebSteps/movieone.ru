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
        <script async src="../assets/player.js"></script>
        <!-- Scripts -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>

    <body class="bg-slate-100">
        @inertia
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "../assets/metrica.js", "ym"); ym(94438576, "init", { clickmap:false, trackLinks:false, accurateTrackBounce:false }); </script> <noscript>...</noscript>
        <!-- /Yandex.Metrika counter -->

    </body>

</html>
