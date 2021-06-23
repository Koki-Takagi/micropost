<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
        public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        // ユーザのフォローしてるユーザの投稿を含めて表示　タイムラインを共有するためにfeed_microposts()を使う
        $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    //プロフィール更新ページへ遷移
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // 認証済みユーザがこのidのユーザであれば編集画面へ
        if(\Auth::id() == $user->id){
        return view('users.edit', [
            'user' => $user
            ]);
        }
        return back();
    }
    
    //プロフィール変更のput
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->profile = $request->profile;
        $user->save();
        // showページに戻るための値を用意
                // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        return view('users.show',[
            'user' => $user,
            'microposts' => $microposts,
            ]);
        
    }
    
    
    public function ownposts($id)
    {
         // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('users.show',[
            'user' => $user,
            'microposts' => $microposts,
            ]);
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    //　$id のユーザがファボした投稿一覧を表示するアクション
    public function favorites($id)
    {
         // idの値でユーザを検索して取得
        $user = User::findOrFail($id);  
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザのファボした投稿一覧を取得
        $favorites = $user->favorites()->paginate(10);
        
        //ファボ一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
            ]);
    }
}
