<button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-12 text-center text-sm text-white uppercase cursor-pointer drop-shadow-2xl border border-green-900 rounded-md font-semibold tracking-widest px-4 py-2 bg-green-950 hover:bg-green-900 focus:bg-green-800 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
