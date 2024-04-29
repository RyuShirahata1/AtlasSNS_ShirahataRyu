<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
   public function index(){
    // Postテーブルからレコードを取得
    $list = Post::get();
    // bladeへ返すときにデータを送る
    return view('posts.index', ['list' => $list]);
}

    // 投稿機能
    public function added(Request $request){
        $id = $request->input('id');
        $user_id = $request->input('user_id');
        $post = $request->input('newPost');
        $created_at = $request->input('created_at');
        Post::create([
            //'id' => $id,
            'user_id' => $user_id,
            'post' => $post,
        ]);
        return back();
    }

    //編集
    // 編集
public function update(Request $request){
    $id = $request->input('id');
    $up_post = $request->input('upPost');

    // ログインユーザーのIDを取得
    $user_id = auth()->id();

    // ログインユーザーが所有する投稿のみを編集
    Post::where('id', $id)
        ->where('user_id', $user_id)
        ->update(['post' => $up_post]);

    return back();
}

    // 削除
public function destroy($id)
{
    // ログインユーザーのIDを取得
    $user_id = auth()->id();

    // 指定されたIDの投稿がログインユーザーのものであることを確認して削除
    Post::where('id', $id)
        ->where('user_id', $user_id)
        ->delete();

    return back();
}
}
