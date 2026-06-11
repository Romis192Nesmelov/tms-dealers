<x-auth-layout>
    <form method="POST" action="{{ route('auth.sign_in') }}" class="rounded-xl shadow-2xl w-full md:w-120 bg-green-950 border-2 border-green-500 text-white flex flex-col items-center justify-center p-7">
            @csrf
            <img id="logo" class="w-20 mb-4 shadow-xl" src="{{ asset('storage/images/logo.svg') }}"/>
            <h1 class="uppercase font-semibold text-2xl">Авторизация</h1>
            <p class="w-full text-center text-white font-sm mb-5">Введите свой логин и пароль.</p>
            <x-input name="email" placeholder="E-mail"></x-input>
            <x-input name="password" type="password" placeholder="Пароль"></x-input>
            <x-checkbox name="remember" checked="1" label="Запомнить меня"></x-checkbox>

            <x-submit-button class="w-full">Авторизоваться</x-submit-button>
    </form>
</x-auth-layout>
