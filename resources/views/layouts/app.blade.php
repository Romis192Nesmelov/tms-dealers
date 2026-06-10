<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ТМС Dealers') }}</title>

    @include('partials.favicons')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey={{ env('YANDEX_API_KEY') }}&lang=ru_RU" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>

    @vite([
        'resources/css/app.css',
        'resources/css/main.css',
        'resources/js/app.js',
        'resources/js/main.js'
    ])
</head>
<body class="bg-neutral-950">
    <div class="w-full bg-green-950 border-b-2 border-green-800 absolute z-50">
        <div class="max-w-7xl mx-auto py-5">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex flex-col md:flex-row items-center justify-center">
                    <img class="w-20 ml-0 mr-0 md:ml-4 md:mr-3 mt-3 md:mt-0" src="{{ asset('storage/images/logo.svg') }}"/>
                    <p class="text-center md:text-left text-2xl leading-6 text-white font-semibold pt-3 md:pt-0">- дилеры</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- /Page Content -->
</body>
</html>
