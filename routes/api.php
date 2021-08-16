<?php

use App\Controllers\CommentController;
use App\Controllers\FollowController;
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

//? User

Route::post('/accounts/signin', [UserController::class, 'signin']); //*user signin

Route::post('/accounts/signup', [UserController::class, 'signup']); //*user signup

Route::post('/u/auth', [UserController::class, 'auth']); //*check user auth

Route::post('/u/avatar', [UserController::class, 'avatar']); //*upload user avatar

Route::post('/u/delete', [UserController::class, 'destroy']); //* delete user

Route::post('/u/update', [UserController::class, 'update']); //* update user

Route::post('/u/profile/{uid}', [UserController::class, 'show']); //* show user profile by id


//? Publish

Route::post('/p/publish', [PostController::class, 'store']); //* publish snippet

Route::get('/p/page/{page}', [PostController::class, 'pagination']); //* get pagination snippet

Route::get('/p/{id}', [PostController::class, 'getOnePostByUrl']); //* get One Post By Url

Route::get('/p/tag/{tag}/{page}', [PostController::class, 'getAllPostByTag']); //* get One Post By Tag

Route::get('/p/top/{page}', [PostController::class, 'getAllPostByTop']); //* get All Posts By Top

Route::post('/p/delete', [PostController::class, 'destroy']); //* delete a publish

Route::post('/me/all/p', [PostController::class, 'getAllPostsByUser']); //* get All Posts By User


//? Like

Route::post('/p/like', [LikeController::class, 'store']); //* store like


//? Comment

Route::post('/p/comment', [CommentController::class, 'store']); //* store comment

Route::get('/p/{id}/comment/{page}', [CommentController::class, 'pagination']); //* get pagination comment


//? Follow

Route::post('/follow', [FollowController::class, 'store']); //* store follow

Route::post('/unfollow', [FollowController::class, 'destroy']); //* destroy follow

Route::post('/follow/show', [FollowController::class, 'show']);//* show follow
