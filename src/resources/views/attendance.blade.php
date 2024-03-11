<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
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
            <li class="header-nav__item">
              <form>
                <button class="header-nav__button">ログアウト</button>
              </form>
            </li>
          </ul>
        </nav>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>2024年2月14日</h2>
      </div>


    　<table class="admin__table">
      <tr class="admin__row">
        <th class="admin__label">名前</th>
        <th class="admin__label">勤務開始</th>
        <th class="admin__label">勤務終了</th>
        <th class="admin__label">休憩時間</th>
        <th class="admin__label">勤務時間</th>
      </tr>
      <tr class="admin__row">
        @auth
        <td class="admin__data">{{Auth::user()->name}}</td>
        @endauth
        <td class="admin__data">{{$work_start}}</td>
        <td class="admin__data">{{$time}}</td>
        <td class="admin__data">{{$rest_total}}</td>
        <td class="admin__data">{{$time}}</td>
      </tr>
      <!-- かつ、foreachで繰り返し表示? -->
      <tr class="admin__row">
        <td class="admin__data">※テスト太郎</td>
        <td class="admin__data">10:00:00</td> 
        <td class="admin__data">20:00:00</td>
        <td class="admin__data">00:30:00</td>
        <td class="admin__data">09:30:00</td>
      </tr>
      <tr class="admin__row">
        <td class="admin__data">※テスト花子</td>
        <td class="admin__data">10:00:00</td> 
        <td class="admin__data">20:00:00</td>
        <td class="admin__data">00:30:00</td>
        <td class="admin__data">09:30:00</td>
      </tr>
            <tr class="admin__row">
        <td class="admin__data">※テスト三郎</td>
        <td class="admin__data">10:00:00</td> 
        <td class="admin__data">20:00:00</td>
        <td class="admin__data">00:30:00</td>
        <td class="admin__data">09:30:00</td>
      </tr>
            <tr class="admin__row">
        <td class="admin__data">※テスト義夫</td>
        <td class="admin__data">10:00:00</td> 
        <td class="admin__data">20:00:00</td>
        <td class="admin__data">00:30:00</td>
        <td class="admin__data">09:30:00</td>
      </tr>

    </table>
  </main>

  <footer>
    <small>Atte,inc.</small>
  </footer>
</body>
</html>