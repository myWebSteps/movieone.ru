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

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        document.addEventListener('DOMContentLoaded', function () {

        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(94438576, "init", {
            defer: true,
            clickmap:false,
            trackLinks:false,
            accurateTrackBounce:false,

        });
        });

    </script>
    <!-- /Yandex.Metrika counter -->
    <noscript><div><img src="https://mc.yandex.ru/watch/94438576" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

</html>
