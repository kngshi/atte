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
      <div class="header__logo">
        Atte
      </div>
      <nav>
          <ul class="header-nav">
            <li class="header-nav__item">
              <a class="header-nav__link" href="/">ホーム</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/attendance">日付一覧</a>
            </li>
            <div class="mt-3_space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <x-responsive-nav-link :href="route('logout')"
                  onclick="event.preventDefault();
                              this.closest('form').submit();"
                  class="header-nav__link text-black !important underline-none !important" >
                  {{ __('ログアウト') }}
                </x-responsive-nav-link>
                </form>
              </div>
          </ul>
        </nav>
    </div>
  </header>

  <main>
    <div class="attendance__content">
      <div class="attendance__heading">
        @auth
        <h2>{{Auth::user()->name}}さんお疲れ様です！</h2>
        @endauth
  
      </div>
    
    <div class="form__group-work" >
    <form class="form" action="{{ route('time.start') }}" method="post">
        @csrf
        <div class="form__button">
          <button class="form__button-submit" type="submit"  name="work_start" value="" {{ session('workStartButtonDisabled') ? 'disabled' : '' }}>勤務開始</button>
        </div>
    </form>

    <form class="form" action="{{ route('time.end') }}" method="post">
          @csrf
        <div class="form__button">
          <button class="form__button-submit"  type="submit" name="work_end" value="" {{ session('workEndButtonDisabled') ? 'disabled' : '' }}>勤務終了</button>
        </div>
    </form>
</div>

<div class="form__group-rest" >
     <form class="form" action="{{ route('rest.start') }}" method="post">
          @csrf
        <div class="form__button">
          <button class="form__button-submit"  type="submit" name="rest_start" value="" {{ session('restStartButtonDisabled') ? 'disabled' : '' }}>休憩開始</button>
        </div>
      </form>

      <form class="form" action="{{ route('rest.end') }}" method="post">
          @csrf
        <div class="form__button">
          <button class="form__button-submit"  type="submit" name="rest_end" value="" {{ session('restEndButtonDisabled') ? 'disabled' : '' }}>休憩終了</button>
        </div>
      </form>
</div>

  </main>

  <footer>
   <small> Atte,inc.</small>
  </footer>
</body>
</html>
