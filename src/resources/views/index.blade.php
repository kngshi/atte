<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Atte
      </a>
      <nav>
          <ul class="header-nav">
            <li class="header-nav__item">
              <a class="header-nav__link" href="/">ホーム</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/attendance">日付一覧</a>
            </li>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
              </div>
          </ul>
        </nav>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        @auth
        <h2>{{Auth::user()->name}}さんお疲れ様です！</h2>
        @endauth
        <!-- 認証したidの人物が表示される変数にすれば良い？ -->
  
      </div>

    <form class="form" action="/" method="post">
        @csrf
      <div class="form__group" >
        <div class="form__button">
          <button class="form__button-submit" type="submit"  name="work_start" value="">勤務開始</button>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit" name="work_end" value="">勤務終了</button>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit" name="rest_start" value="">休憩開始</button>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit" name="rest_end" value="">休憩終了</button>
        </div>
      </div>
    </form>
  </main>

  <footer>
   <small> Atte,inc.</small>
  </footer>
</body>
</html>
