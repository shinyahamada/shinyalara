<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://shinyalara.herokuapp.com/css/insta.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/home.js"></script>
        <title>ホーム画面</title>
    </head>
    <body>
      <div class="header">
        <ul>
          <li><a href="/home">ホーム</a></li>
          <li><a href="/{{$url}}">{{$log}}</a></li>
          <li><a href="{{$p_url}}">投稿</a></li>
        </ul>
      </div>
      <div class="posts">
        @isset($post)
            <ul>
        @foreach ($post as $i)
          <li class="post">
              <div class="post-top">
                <a class="p_user" href="profile/{{ $i->p_user }}">{{ $i->p_user }}</a>
                @if($name == $i->p_user)
                  <form class="delete" action="{{asset('delete/' . $i->post_id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" class="" value="削除"　onclick="{{asset('/delete/' . $i->post_id)}}">
                  </form>
                @endif
              </div>
              <div class="image-space">
                <img src="{{asset('/storage/' . $i->image)}}" class="post-image" alt="">
              </div>
              <div class="p_comment">
                  {{ $i->comment}}
              </div>
              @if($login_user_likes[$i->post_id]['l_user']=$name)
              <div class="like-relations">
                <form class="" action="/like/{{$i->post_id}}" method="post">
                  {{ csrf_field() }}
                  <input {{$disable}}  type="hidden" name="post_id" value="{{$i->post_id}}">
                  <input {{$disable}}  type="hidden" name="p_user" value="{{$i->p_user}}">
                  <div class="like-btn">
                    <input {{ $disable }} type="submit" class="like-btn" value="like">
                  </div>
                </form>
                <div class="like-link">
                  <a class="" href="like/{{$i->post_id}}">いいねしたユーザー</a>
                </div>
              </div>
          </li>
        @endforeach
            </ul>
        @endisset
        {{ $post->links() }}

      </div>


    </body>
</html>
