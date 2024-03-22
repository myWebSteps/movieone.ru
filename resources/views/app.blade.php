<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="04c3bf7c897cb0df" />
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20,100,0,0" />
        <!-- Scripts -->
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
        <script defer src="https://kinobox.tv/kinobox.min.js"></script>
    </head>
    <body class="bg-slate-100">
        @inertia
    </body>


    <!-- Yandex.Metrika counter -->
    <script>
        // Флаг, что Метрика уже загрузилась.
        let loadedMetrica = false
        // Переменная для хранения таймера.
        let timerId;

        // Для бота Яндекса грузим Метрику сразу без "отложки",
        // чтобы в панели Метрики были зелёные кружочки
        // при проверке корректности установки счётчика.
        if ( navigator.userAgent.indexOf( 'YandexMetrika' ) > -1 ) {
            loadMetrica();
        } else {
            // Подключаем Метрику, если юзер начал скроллить.
            window.addEventListener( 'scroll', loadMetrica, {passive: true} );

            // Подключаем Метрику, если юзер коснулся экрана.
            window.addEventListener( 'touchstart', loadMetrica );

            // Подключаем Метрику, если юзер дернул мышкой.
            document.addEventListener( 'mouseenter', loadMetrica );

            // Подключаем Метрику, если юзер кликнул мышкой.
            document.addEventListener( 'click', loadMetrica );

            // Подключаем Метрику при полной загрузке DOM дерева,
            // с "отложкой" в 1 секунду через setTimeout,
            // если пользователь ничего вообще не делал (фоллбэк).
            document.addEventListener( 'DOMContentLoaded', loadFallback );
        }

        function loadFallback() {
            timerId = setTimeout( loadMetrica, 1000 );
        }

        function loadMetrica( e ) {
            // Если флаг загрузки Метрики отмечен,
            // то ничего более не делаем.
            if ( loadedMetrica ) {
                return;
            }

            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();
                for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(94438576, "init", {
                defer: true,
                clickmap:false,
                trackLinks:false,
                accurateTrackBounce:false
            });



            // Отмечаем флаг, что Метрика загрузилась,
            // чтобы не загружать её повторно при других
            // событиях пользователя и старте фоллбэка.
            loadedMetrica = true;

            // Очищаем таймер, чтобы избежать лишних утечек памяти.
            clearTimeout( timerId );

            // Отключаем всех наших слушателей от всех событий,
            // чтобы избежать утечек памяти.
            window.removeEventListener( 'scroll', loadMetrica );
            window.removeEventListener( 'touchstart', loadMetrica );
            document.removeEventListener( 'mouseenter', loadMetrica );
            document.removeEventListener( 'click', loadMetrica );
            document.removeEventListener( 'DOMContentLoaded', loadFallback );
        }


    </script>
    <!-- /Yandex.Metrika counter -->
    <noscript><div><img src="https://mc.yandex.ru/watch/94438576" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

</html>
