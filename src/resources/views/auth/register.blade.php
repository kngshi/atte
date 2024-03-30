<x-guest-layout>
    <header class="bg-gray-900 text-black text-xl">
    <div class="container mx-auto py-4">
        <a class="text-xl font-bold">Atte</a>
    </div>
</header>
    
     <x-auth-card class="">
        <x-slot name="logo" >
            <div>
                <h1 class="text-xl italic font-bold">会員登録</h1>
            </div>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="名前" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('')" />

                <x-input id="password" class="block mt-1 w-full"
                                placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation"  :value="__('')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                placeholder="確認用パスワード"
                                type="password"
                                name="password_confirmation" required />
            </div>

            
            <div class="mt-4 text-center">
                <x-button class="block mt-1 w-full bg-blue-100 text-white bg-blue-500">
                    {{ __('会員登録') }}
                </x-button>
            </div>

            <div class="mt-4 text-center" >
                <div class="login text-center">アカウントをお持ちの方はこちら<br/></div>

                <a class="text-base text-gray-600 hover:text-gray-900 center" href="{{ route('login') }}">
                    {{ __('ログイン') }}
                </a>

                
            </div>
        </form>
    </x-auth-card>
    <footer class="text-base　bg-gray-900 py-4 text-center">
        <small>Atte, Inc.</small>
    </footer>

</x-guest-layout>


