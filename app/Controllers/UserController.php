<?php

namespace App\Controllers;

use App\Http\Middleware\Auth;
use App\Http\Middleware\Middleware;
use App\Http\Request;
use App\Http\Response;
use App\Models\Users;

class UserController extends Controller
{


  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public static function signin(Request $request, Response $response)
  {
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
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public static function signup(Request $request, Response $response)
  {
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
  }


  public static function auth(Request $request, Response $response)
  {
    $authorization = $request->form()->Authorization;
    $user = Auth::verify($authorization);
    $response->json($user->dd ?? null);
  }

  public static function avatar(Request $request, Response $response)
  {
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
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public static function index(Request $request)
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \Http\Request  $request
   */
  public static function show(Request $request, Response $response)
  {
    $authorization = $request->form()->Authorization;
    $user = Auth::verify("Bearer $authorization");
    if (!$user) $response->json(null);
    $uid = $request->params->uid;
    $user = (object) Users::getUser((int)$uid);
    $response->json($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function update(Request $request, Response $response)
  {
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
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public static function destroy(Request $request, Response $response)
  {
    $middleware  = new Middleware();
    $authorization = $request->form()->Authorization;
    $user = Auth::verify("Bearer $authorization");
    if (!$user) $response->json(null);
    if ($user->dd->avatar !== null) $middleware->removeUploaded($user->dd->avatar);
    Users::delete($user->dd->id);
    $response->json($user);
  }
}
