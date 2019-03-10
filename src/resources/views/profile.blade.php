<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://shinyalara.herokuapp.com/css/insta.css">
        <title>プロフィール画面</title>
    </head>
    <body>

      <div class="header">
        <ul>
          <li><a href="/home">ホーム</a></li>
          <li><a href="/{{$url}}">{{$log}}</a></li>
          <li><a href="{{$p_url}}">投稿</a></li>
        </ul>
      </div>
      <div class="user_info">
        <!--github-icon-->
        <img class="u_img" src="{{ asset('https://avatars.githubusercontent.com/' . $p_user)}}" alt="">
        <!--userName-->
        {{$p_user}}
        <!--count(like)-->
        {{$like_count}}
      </div>
        <!--userImages-->
        @isset($post)
        @foreach ($post as $i)
            <img class="p_img" src="{{asset('/storage/' . $i->image)}}" alt="" width="33%" height="auto">
        @endforeach
        @endisset
    </body>
</html>
