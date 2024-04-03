<x-guest-layout>
    <header class="bg-gray-900 text-black text-xl">
        <div class="container mx-auto py-4">
            <a class="text-xl font-bold">Atte</a>
        </div>
    </header>

     <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

     <h1 class="text-xl mb-4">ログイン</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('')" />

                <x-input id="email" class="block mt-4 w-full" type="email" name="email"
                placeholder="メールアドレス" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('')" />

                <x-input id="password" class="block mt-8 w-full"
                                placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            

            <div class="flex items-center justify-end mt-4">
                <x-button class="block mt-4 w-full text-white bg-blue-500">
                    {{ __('ログイン') }}
                </x-button>
            </div>
             <div class="mt-4 text-center" >
                <div class="login text-center  ">アカウントをお持ちでない方はこちら<br/></div>

                <a class="text-base text-blue-500 hover:text-blue-700 center" href="{{ route('register') }}">
                    {{ __('会員登録') }}
                </a>
            </div>
        </form>
    </div>
    <footer class="text-base　bg-gray-900 py-4 text-center">
        <small>Atte, Inc.</small>
    </footer>

</x-guest-layout>
