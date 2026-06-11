<button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-12 text-center text-sm text-white uppercase cursor-pointer shadow-2xl px-4 py-2 bg-green-900 hover:bg-green-800 focus:bg-green-800 border rounded-md font-semibold tracking-widest hover:bg-green-800 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
