<?php

use App\Controllers\CommentController;
use App\Controllers\LikeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Routing\Route;

/*
|------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------
|
| Here is where you can register API routes for your application. 
|
*/

Route::post('/accounts/signin', [UserController::class, 'signin']);
Route::post('/accounts/signup', [UserController::class, 'signup']);
Route::post('/u/auth', [UserController::class, 'auth']);
Route::post('/u/avatar', [UserController::class, 'avatar']);
Route::post('/u/delete', [UserController::class, 'destroy']);
Route::post('/u/update', [UserController::class, 'update']);
Route::post('/u/profile/{uid}', [UserController::class, 'show']);


Route::post('/p/publish', [PostController::class, 'store']);
Route::get('/p/page/{page}', [PostController::class, 'pagination']);
Route::get('/p/{id}', [PostController::class, 'getOnePostByUrl']);
Route::get('/p/tag/{tag}/{page}', [PostController::class, 'getAllPostByTag']);
Route::get('/p/top/{page}', [PostController::class, 'getAllPostByTop']);
Route::post('/p/delete', [PostController::class, 'destroy']);
Route::post('/me/all/p', [PostController::class, 'getAllPostsByUser']);


Route::post('/p/like', [LikeController::class, 'store']);


Route::post('/p/comment', [CommentController::class, 'store']);
Route::get('/p/{id}/comment/{page}', [CommentController::class, 'pagination']);
