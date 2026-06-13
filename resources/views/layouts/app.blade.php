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
        'resources/css/icons/icomoon/styles.css',
        'resources/css/app.css',
        'resources/css/main.css',
        'resources/js/app.js',
        'resources/js/helper.js',
        'resources/js/main.js'
    ])
</head>
<body class="bg-neutral-950">
    <div class="w-full bg-green-950 opacity-80 border-b-2 border-green-500 absolute z-50 p-2">
        <div class="flex items-center justify-start">
            <button id="hamburger" class="p-2 ml-3 rounded-md border border-white text-white hover:text-green-500 hover:border-green-500 focus:border-green-500 focus:bg-green-900 focus:text-green-500 cursor-pointer">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img id="logo" class="w-20 ml-4 cursor-pointer hover:opacity-55" src="{{ asset('storage/images/logo.svg') }}"/>
        </div>
    </div>

    <div id="menu" class="absolute rounded-xl w-full mt-16 ml-0 mr-1 md:block md:w-auto md:mt-20 md:ml-3 px-7 py-5 bg-green-950 border-2 opacity-80 border-green-500 text-white z-50"></div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- /Page Content -->
</body>
</html>
