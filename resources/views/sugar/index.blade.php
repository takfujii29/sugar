<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>list</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="/css/reset.css" rel="stylesheet" type="text/css">
  </head>
  <body>
   
    @if (Auth::check())
    <p>USER: {{$user->name}}</p>
    @else
    <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
    @endif

    <a href="/sugar/create">間食登録</a>

    <div class="main">
      <div class="title">
        <h2 >摂取糖質一覧</h2>
      </div>

      <div class="list">
        <table>
          <thead>
            <tr>
              <th>日付</th>
              <th>総糖質</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($userProducts as $userProduct)
            <tr>
              <td>{{ $userProduct->date}}</td>
              <td>{{ $userProduct->total_sugar}}</td>
              <td><a href="/sugar/show/{{$user->id}}/{{ $userProduct->date}}" >詳細</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>