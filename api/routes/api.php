<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['cors'])->group(function () {
  Route::options('accounts', function () {
    return response()->json();
  });

  // 新規登録
  Route::post("/users/register", "LoginController@register");
  // ログイン
  Route::post("/users/login", "LoginController@login");
  // (ログイン必須) 投稿
  Route::post("/posts/store", "PostController@store");
  // 投稿一覧
  Route::get("/posts/index", "PostController@index");
  // Route::middleware("auth:api")->post("/posts/store", "PostController@store");
});
