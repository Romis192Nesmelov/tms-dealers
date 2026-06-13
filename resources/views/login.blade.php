<x-auth-layout>
    <form method="POST" action="{{ route('auth.sign_in') }}" class="rounded-xl drop-shadow-2xl w-full md:w-90 bg-neutral-800 border border-green-900 text-white flex flex-col items-center justify-center p-7">
        @csrf
        <img id="logo" class="w-20 mb-4 shadow-xl" src="{{ asset('storage/images/logo.svg') }}"/>
        <h1 class="uppercase font-semibold text-xl text-neutral-300">Дилеры. Авторизация</h1>
        <p class="w-full text-center text-neutral-300 text-sm mb-5">Введите свой логин и пароль.</p>

        <x-input name="email" placeholder="E-mail" value="{{ old('email') ?? '' }}"></x-input>
        <x-input name="password" type="password" placeholder="Пароль"></x-input>
        <x-checkbox name="remember" checked="1" label="Запомнить меня"></x-checkbox>

        <x-submit-button class="w-full">Авторизоваться</x-submit-button>
    </form>
</x-auth-layout>
