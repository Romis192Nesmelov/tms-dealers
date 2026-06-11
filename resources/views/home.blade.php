<x-app-layout>
    <div class="w-full">
        <div id="map" class="w-full min-h-screen"></div>
    </div>
    <script>
        window.cities = {!! json_encode($cities)  !!};
        window.geo_api_key = "{{ env('YANDEX_GEO_API_KEY') }}";
        window.dealersCount = parseInt("{{ $countDealers }}");
    </script>
</x-app-layout>
