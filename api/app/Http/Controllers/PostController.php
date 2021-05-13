<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// model
use App\Models\Post;

// Validation
use App\Http\Requests\StorePost;

class PostController extends Controller
{
  // 投稿一覧を取得する
  public function index()
  {
    return Post::all();
  }

  // 投稿を保存する
  public function store(StorePost $request)
  {
    $post = new Post;
    $post->fill($request->all())->save();
  }

  // 投稿詳細を取得する
  public function show($url)
  {
    $post = Post::where("url", $url)->first();
    return $post;
  }

  // 投稿を更新する
  public function update(Request $request, $url)
  {
    $post = Post::where("url", $url)->first();
    $post->fill($request->all())->save();
  }
}
