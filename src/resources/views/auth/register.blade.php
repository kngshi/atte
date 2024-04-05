<x-guest-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    </head>

    <header class="bg-gray-900 text-black text-2xl">
        <div class="container mx-auto py-4 ">
            <p class="text-xl font-bold">Atte</p>
        </div>
    </header>
    

   <main class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 h-80vh">

     <h1 class="text-xl mb-4">会員登録</h1>
        
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('')" />

                <x-input id="name" class="block mt-4 w-full" type="text" name="name" placeholder="名前" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('')" />

                <x-input id="email" class="block mt-8 w-full" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('')" />

                <x-input id="password" class="block mt-8 w-full"
                                placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation"  :value="__('')" />

                <x-input id="password_confirmation" class="block mt-8 w-full"
                                placeholder="確認用パスワード"
                                type="password"
                                name="password_confirmation" required />
            </div>

            
            <div class="mt-4">
                <x-button class="block mt-4 w-full text-white bg-blue-500  hover:bg-blue-700 mx-auto">
                    {{ __('会員登録') }}
                </x-button>
            </div>

            <div class="mt-4 text-center" >
                <div class="login text-center">アカウントをお持ちの方はこちら<br/></div>

                <a class="text-base text-blue-500 hover:text-blue-500 center" href="{{ route('login') }}">
                    {{ __('ログイン') }}
                </a>

                
            </div>
        </form>

</main>

    <footer class="text-base　bg-gray-900 py-4 text-center"　style="height: 20vh;">
        <small>Atte, Inc.</small>
    </footer>

</x-guest-layout>


