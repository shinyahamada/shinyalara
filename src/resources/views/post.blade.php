<!DOCTYPE HTML>
<html>
<head>
    <title>投稿画面</title>
    <link rel="stylesheet" href="https://shinyalara.herokuapp.com/css/insta.css">
</head>
<body>

  <div class="header">
    <ul>
      <li><a href="/home">ホーム</a></li>
      <li><a href="/{{$url}}">{{$log}}</a></li>
      <li><a href="{{$p_url}}">投稿</a></li>
    </ul>
  </div>


<!-- フォームエリア -->
<div class="image-form">
    <form action="{{ url('post') }}" method="POST" enctype="multipart/form-data">

        <label for="photo">写真を選択</label>
        <input type="file" class="form-control" name="file">
        <br>
        <textarea name="comment" rows="5" cols="40" maxlength="200"></textarea>

        {{ csrf_field() }}
        <div class="">
          <button class="btn btn-success"> 投稿 </button>
        </div>
    </form>
</div>


</body>
</html>
