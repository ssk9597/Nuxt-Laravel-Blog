<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// model
use App\Models\Post;

class PostController extends Controller
{
  // 投稿一覧を取得する
  public function index()
  {
    return Post::all();
  }

  // 投稿を保存する
  public function store(Request $request)
  {
    $post = new Post;
    $post->fill($request->all())->save();
  }
}
