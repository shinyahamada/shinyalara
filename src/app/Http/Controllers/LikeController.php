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



class LikeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request, $post_id)
     {
       $token = $request->session()->get('github_token');
       if (empty($token)) {
         $log = "ログイン";
         $url = "/";
         $p_url="/";
       }else{
         $log = "ログアウト";
         $url = "logout";
         $disable="";
         $p_url="/post";
       }

       //ここでliketable 取得
       //受けたpost_id 使ってl_userを取得

       $like = DB::table("like")
       ->where('post_id', '=', $post_id)
       ->get();

       return view('like',[
         'log' => $log,
         'url' => $url,
         'like' => $like,
         'disable' => $disable,
         'p_url' => $p_url
       ]);


     }

    public function like(Request $request, $post_id)
    {
      $token = $request->session()->get('github_token');
      try {
          $github_user = Socialite::driver('github')->userFromToken($token);
      } catch (\Exception $e) {
          return redirect('login/github');
      }

      //ここでliketable insert

          $l_user = $github_user->nickname;
          $p_user = $request->input('p_user');

          // liketableに両方あるカラムがあるかないか条件分岐

          $like = DB::table("like")
          ->where([
            ['post_id', '=', $post_id],
            ['l_user', '=', $l_user]
          ])->get();

          if(count($like)){
            //delete
            DB::table("like")
            ->where([
              ['post_id', '=', $post_id],
              ['l_user', '=', $l_user]
            ])->delete();
          }else{
            //insert
            $post_id = $request->input('post_id');
            DB::table("like")
            ->insert(
              ['post_id' => $post_id, 'l_user' => $l_user, 'p_user' => $p_user]
            );

          }

          return redirect()
                 ->action('HomeController@index');
    }
  }
