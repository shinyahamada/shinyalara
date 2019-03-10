<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/insta.css')}}">
        <title>いいねしたユーザ一覧</title>
    </head>
    <body>
      <div class="header">
        <ul>
          <li><a href="/home">ホーム</a></li>
          <li><a href="/{{$url}}">{{$log}}</a></li>
          <li><a href="{{$p_url}}">投稿</a></li>
        </ul>
      </div>
      <div class="like-user">
        @isset($like)
            <ul>
        @foreach ($like as $i)
          <li>
            <a class="u-image " href="/profile/{{ $i->l_user }}"><img class="l_user_img" src="{{ asset('https://avatars.githubusercontent.com/' . $i->l_user)}}" width="100px" height="100px" alt=""></a>
            <a class="l-user" href="/profile/{{ $i->l_user }}">{{ $i->l_user }}</a>
          </li>
        @endforeach
            </ul>
        @endisset

      </div>


    </body>
</html>
