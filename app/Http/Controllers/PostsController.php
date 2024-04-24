<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // すべての投稿を取得する

        return view('posts.index', compact('posts')); // 投稿一覧をビューに渡す
    }
}
