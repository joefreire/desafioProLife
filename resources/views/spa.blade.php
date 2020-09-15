<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Teste Prossigo</title>

        <script src="{{ mix('js/app.js') }}" defer></script>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="bg-light">
        <div class="container-full">
            <div class="content vld-parent">
                <div id="app">
                    <ul class="nav bg-info mb-2">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('/#/form') }}">Contato</a>
                        </li>
                    </ul>
                    <loading :active.sync="isLoading" :is-full-page="fullPage"></loading>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </body>
</html>
