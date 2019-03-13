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



class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function top(Request $request)
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
      return view('post',[
        'log' => $log,
        'url' => $url,
        'p_url' => $p_url
      ]);



    }

    /**
         * ファイルアップロード処理
         */
        public function post(Request $request)
        {
            $this->validate($request, [
                'file' => [
                    // 必須
                    'required',
                    // アップロードされたファイルであること
                    'file',
                    // 画像ファイルであること
                    'image',
                    // MIMEタイプを指定
                    'mimes:jpeg,png,gif',
                    //'required|max:60000'
                ]
            ]);

            $token = $request->session()->get('github_token', null);

            try {
                $github_user = Socialite::driver('github')->userFromToken($token);
            } catch (\Exception $e) {
                return redirect('login/github');
            }



            if ($request->file('file')->isValid([])) {
                $path = $request->file->store('public');
                $path = str_replace("public/", "", $path);
                $comment = $request->input('comment');
                $name = $github_user->nickname;
                DB::table('post')
                ->insert(
                    ['p_user' => $name, 'image' => $path, 'comment' => $comment]
                  );

                  return redirect('home');

            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors();
            }
        }

        public function delete(Request $request, $post_id)
        {
          DB::table('post')
          ->where('post_id', '=', $post_id)
          ->delete();

          return redirect('home');



        }
}
