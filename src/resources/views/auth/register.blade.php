<x-guest-layout>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Atte</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>

    <header class="header">
        <div class="header__inner">
            <div class="header__logo">Atte</div>
        </div>
    </header>

    <main class="sm:justify-center">

        <h2 class="">会員登録</h2>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}" class="form-content">
            @csrf
            <!-- Name -->
            <div>
                <x-label for="name" :value="__('')" />
                <x-input id="name" class="form-content" type="text" name="name" placeholder="名前" :value="old('name')" required autofocus />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('')" />
                <x-input id="email" class="form-content" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('')" />
                <x-input id="password" class="form-content"
                                placeholder="パスワード"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation"  :value="__('')" />
                <x-input id="password_confirmation" class="form-content"
                                placeholder="確認用パスワード"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4 form-container">
                <x-button class="form-button">
                    {{ __('会員登録') }}
                </x-button>
            </div>

            <div class="mt-4 login" >
                <div class="login-text">アカウントをお持ちの方はこちら<br/></div>
                <a class="login-link" href="{{ route('login') }}">
                    {{ __('ログイン') }}
                </a>
            </div>
        </form>
    </main>

    <footer class="footer">
        <small>Atte, Inc.</small>
    </footer>

</x-guest-layout>


