<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function profiledit(Request $request){
    // 認証されたユーザーからユーザーデータを取得する
    $user = Auth::user();

    // 入力データをバリデートする
    $validatedData = $request->validate([
        'name' => 'required|string|max:255|min:2|max:12',
        'mail' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
        'password' => 'nullable|string|min:8|max:20|confirmed', // password_confirmationフィールドが送信されていることを確認する
        'bio' => 'nullable|string|max:150',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像がアップロードされていると仮定する
    ]);

    // ユーザーデータを更新する
    $user->username = $validatedData['name'];
    $user->mail = $validatedData['mail'];
    if (!empty($validatedData['password'])) {
    $user->password = bcrypt($validatedData['password']); // パスワードをハッシュ化する
}

    $user->bio = $validatedData['bio'];

    // 画像が提供されている場合はアップロードを処理する
    if ($request->hasFile('images')) {
        $image = $request->file('images');
        $imageName = time().'.'.$image->extension();
        $image->storeAs('public', $imageName); // 画像をストレージに保存する
        $user->images = $imageName;
    }

    $user->save(); // 更新されたユーザーデータを保存する

    // プロフィールが更新されたら、トップページにリダイレクトする
    return redirect('/top');
}

    public function search(Request $request){
    $keyword = $request->input('keyword');

    // 検索キーワードが入力されている場合は部分一致で検索
    if(!empty($keyword)){
        $users = User::where('username', 'like', '%' . $keyword . '%')->paginate(20);
    } else {
        // 検索キーワードが入力されていない場合は全てのユーザーを取得
        $users = User::paginate(20);
    }

    // ビューにユーザー情報と検索キーワードを渡す
    return view('users.search', compact('users', 'keyword'));
}

    public function follow(User $user)
{
    $follower = auth()->user(); // 認証されたユーザーを取得
    $is_following = $follower->isFollowing($user->id); // ユーザーが特定のユーザーをフォローしているか確認
    if (!$is_following) {
        $follower->follow($user->id); // フォローする
    }
    return back();
}

public function unfollow(User $user)
{
    $follower = auth()->user(); // 認証されたユーザーを取得
    $is_following = $follower->isFollowing($user->id); // ユーザーが特定のユーザーをフォローしているか確認
    if ($is_following) {
        $follower->unfollow($user->id); // フォローを解除する
    }
    return back();
}


}
