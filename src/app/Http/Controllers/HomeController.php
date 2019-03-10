<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Model\Images;
use App\Model\Like;
use App\Model\Post;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $token = $request->session()->get('github_token');
      try {
          $github_user = Socialite::driver('github')->userFromToken($token);
      } catch (\Exception $e) {
          return redirect('login/github');
      }

      if (empty($token)) {
        $log = "ログイン";
        $url = "/";
        $disable= "disabled";
        $p_url="/";
        $name="";
      }else{
        $log = "ログアウト";
        $url = "logout";
        $disable= "";
        $p_url="/post";
        $name = $github_user->nickname;
      }
      $post = DB::table('post')
      ->orderBy('post_id', 'desc')
      ->simplePaginate(10);

      $login_user_likes = DB::table("like")
      ->where('l_user', '=', $name)
      ->get();


      return view('home', [
        "post" => $post,
        'log' => $log,
        'url' => $url,
        'disable' => $disable,
        'name' => $name,
        'login_user_likes' => $login_user_likes,
        'p_url' => $p_url
      ]); // bbs.indexにデータを渡す



    }
    }
