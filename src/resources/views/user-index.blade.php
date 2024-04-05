<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/user-index.css') }}" />
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
              <a class="header-nav__link" href="/user-index">ユーザー 一覧</a>
            </li>
            <li class="header-nav__item">
              <a class="header-nav__link" href="/attendance">ユーザー別 勤怠一覧</a>
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
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>ユーザー 一覧</h2>
      </div>
    

    　<table class="admin__table">
      <tr class="admin__row">
        <th class="admin__label">名前</th>
        <th class="admin__label">メールアドレス</th>
         <th class="admin__label">メール認証時刻</th>
      </tr>
      @foreach($users as $user)
      <tr class="admin__row">
        <td class="admin__data">{{ $user->name }}</td>
        <td class="admin__data">{{ $user->email }}</td>
        <td class="admin__data">{{ $user->email_verified_at }}</td>
      </tr>
       @endforeach
    </table>
     
   </div>
  </main>

  <footer>
    <small>Atte,inc.</small>
  </footer>

</body>
</html>