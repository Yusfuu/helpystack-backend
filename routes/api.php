<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\Middleware;
use App\Http\Request;
use App\Http\Response;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Posts;
use App\Models\Users;
use App\Routing\Route;

/*
|------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------
|
| Here is where you can register API routes for your application. 
|
*/



Route::post('/accounts/signin', function (Request $request, Response $response) {
  $user = $request->form();
  $_user = Users::findBy(['email' => $user->email]);
  [$_user] = empty($_user) ? null : $_user;
  if (!$_user) {
    return $response->json(["message" => "Email Not Found"]);
  } else {
    if (password_verify($user->password, $_user['password'])) {
      unset($_user['password']);
      $_user['__token__'] = Auth::create($_user);
      $response->json($_user);
    } else {
      $response->json(["message" => "password incorrect"]);
    }
  }
});

Route::post('/accounts/signup', function (Request $request, Response $response) {
  $user = $request->form();
  if (!!count(Users::findBy(['email' => $user->email], ["email"]))) {
    return $response->json(["message" => "Email must be unique, already taken"]);
  }
  $password = password_hash($user->password, PASSWORD_DEFAULT);
  $user->password = $password;
  $id = Users::create($user);
  unset($user->password);
  $user->id = $id;
  $user->avatar = null;
  $user->bio = null;
  $user->twitter = null;
  $user->__token__ = Auth::create($user);
  $response->json($user);
});

Route::post('/u/auth', function (Request $request, Response $response) {
  $authorization = $request->form()->Authorization;
  $user = Auth::verify($authorization);
  $response->json($user->dd ?? null);
});

Route::get('/me', function (Request $request, Response $response) {
  $x = $request->authorization();
  $response->json($x);
});

function clean($string)
{
  $string = str_replace('', '-', $string); // Replaces spaces with hyphens.
  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

Route::post('/p/publish', function (Request $request, Response $response) {
  $json = $request->form();
  $authorization = $json->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  unset($json->Authorization);
  $json->url = md5(rand());
  $json->uid = $user->dd->id;
  $json->code = addslashes($json->code);
  Posts::create($json);
  $response->json($json);
});


// Route::get('/p/all', function (Request $request, Response $response) {
//   $posts = Posts::fetchAll("SELECT p.id as post_id,p.uid,p.background,p.code,p.description,p.lang,p.color,p.tags,p.name,p.created_at,u.email,u.fullName, COALESCE(likes.LikeCNT, 0) AS likeCount FROM posts p INNER JOIN users u ON p.uid = u.id LEFT JOIN (SELECT COUNT(likes.post_id) LikeCNT, likes.post_id FROM likes GROUP BY likes.post_id) likes on likes.post_id = p.id ORDER BY created_at DESC;");
//   $response->json($posts);
// });

Route::post('/p/like', function (Request $request, Response $response) {
  $post_id = $request->form()->post_id;
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  $data = (object)['uid' => $user->dd->id, 'post_id' => $post_id];
  Likes::create($data);
  $response->json($data);
});

Route::post('/p/comment', function (Request $request, Response $response) {
  $post_id = $request->form()->post_id;
  $body = $request->form()->body;
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  $data = (object)['uid' => $user->dd->id, 'post_id' => $post_id, 'body' => $body];
  Comments::create($data);
  $response->json($data);
});


Route::get('/p/{id}/comment/{page}', function (Request $request, Response $response) {
  $page = $request->params->page;
  $id = $request->params->id;
  $comments = Comments::pagination($page, $id);
  $response->json($comments);
});


Route::get('/p/page/{page}', function (Request $request, Response $response) {
  $page = $request->params->page;
  $posts = Posts::pagination($page);
  $response->json($posts);
});


Route::get('/p/{id}', function (Request $request, Response $response) {
  $url = $request->params->id;
  $post = Posts::getOnePostByUrl($url);
  $response->json($post);
});



Route::get('/p/tag/{tag}/{page}', function (Request $request, Response $response) {
  $tag = $request->params->tag;
  $page = $request->params->page;
  $posts = Posts::getAllPostByTag($tag, $page);
  $response->json($posts);
});

Route::get('/p/top/{page}', function (Request $request, Response $response) {
  $page = $request->params->page;
  $posts = Posts::getAllPostByTop($page);
  $response->json($posts);
});


Route::post('/p/delete', function (Request $request, Response $response) {
  $post_id = $request->form()->post_id;
  Posts::delete($post_id);
  $response->json("deleted");
});


Route::post('/me/all/p', function (Request $request, Response $response) {
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  $posts = Posts::getAllPostsByUser($user->dd->id);
  $response->json($posts);
});


Route::post('/u/avatar', function (Request $request, Response $response) {
  $middleware  = new Middleware();
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  if ($user->dd->avatar !== null) $middleware->removeUploaded($user->dd->avatar);
  $upload = $middleware->upload('avatar');
  if (!$upload->status) $response->json($upload);
  $uid = $user->dd->id;
  Users::update((object)['avatar' => $upload->message], $uid);
  $user = (object) Users::getUser((int)$uid);
  $user->__token__ = Auth::create($user);
  $response->json($user);
});

Route::post('/u/delete', function (Request $request, Response $response) {
  $middleware  = new Middleware();
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  if ($user->dd->avatar !== null) $middleware->removeUploaded($user->dd->avatar);
  Users::delete($user->dd->id);
  $response->json($user);
});

Route::post('/u/update', function (Request $request, Response $response) {
  $authorization = $request->form()->Authorization;
  $fullName = $request->form()->fullName;
  $twitter = $request->form()->twitter;
  $bio = $request->form()->bio;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  Users::update((object)['fullName' => $fullName, 'bio' => addslashes($bio), 'twitter' => $twitter], $user->dd->id);
  $user = (object) Users::getUser((int)$user->dd->id);
  $user->__token__ = Auth::create($user);
  $response->json($user);
});


Route::post('/u/profile/{uid}', function (Request $request, Response $response) {
  $authorization = $request->form()->Authorization;
  $user = Auth::verify("Bearer $authorization");
  if (!$user) $response->json(null);
  $uid = $request->params->uid;
  $user = (object) Users::getUser((int)$uid);
  $response->json($user);
});
