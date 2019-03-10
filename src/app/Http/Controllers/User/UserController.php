<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $token = $request->session()->get('github_token', null);
        $user = Socialite::driver('github')->userFromToken($token);

        DB::update('update public.user set name = ?, comment = ? where github_id = ?', [$request->input('name'), $request->input('comment'), $user->user['login']]);
        return redirect('/github');
    }

    public function info(Request $request, $p_user)
    {
      $token = $request->session()->get('github_token');

      if (empty($token)) {
        $log = "ログイン";
        $url = "/";
        $p_url="/";
      }else{
        $log = "ログアウト";
        $url = "logout";
        $p_url="/post";
      }

      $post = DB::table('post')
      ->orderBy('post_id', 'desc')
      ->get();

      $like_count = DB::table('user')
      ->join("like", 'public.user.github_id', '=', "like.p_user")
      ->select("like.l_user")
      ->count();

        return view('profile',[
          'log' => $log,
          'url' => $url,
          'p_user' => $p_user,
          'post' => $post,
          'like_count' => $like_count,
          'p_url' => $p_url
        ]);

    }

    public function logout(Request $request)
    {
      $request->session()->forget('github_token');
      return redirect('/');

    }
}
