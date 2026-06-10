<x-app-layout>
    <div class="w-full">
        <div id="map" class="w-full min-h-screen"></div>
    </div>
    <script>
        window.dealers = {!! json_encode($dealers)  !!};
    </script>
</x-app-layout>
