<x-guest-layout>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Atte</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">Atte</div>
        </div>
    </header>
    <main class="sm:justify-center">
        <h2 class="">ログイン</h2>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('login') }}" class="form-content">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('')" />
                <x-input id="email" class="form-content" type="email" name="email"
                placeholder="メールアドレス" :value="old('email')" required autofocus />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('')" />
                <x-input id="password" class="form-content"
                                placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
            <div class="form-container">
                <x-button class="form-button">
                    {{ __('ログイン') }}
                </x-button>
            </div>
            <div class="mt-4 register" >
                <div class="register-text">アカウントをお持ちでない方はこちら<br/></div>
                <a class="register-link" href="{{ route('register') }}">
                    {{ __('会員登録') }}
                </a>
            </div>
        </form>
    </div>
</main>
    <footer class="footer">
        <small>Atte, Inc.</small>
    </footer>
</x-guest-layout>
