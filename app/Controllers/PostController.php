<?php

namespace App\Controllers;

use App\Http\Middleware\Auth;
use App\Http\Request;
use App\Http\Response;
use App\Models\Posts;

class PostController extends Controller
{

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
  public static function store(Request $request, Response $response)
  {
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
  }


  public static function pagination(Request $request, Response $response)
  {
    $page = $request->params->page;
    $posts = Posts::pagination($page);
    $response->json($posts);
  }


  public static function getOnePostByUrl(Request $request, Response $response)
  {
    $url = $request->params->id;
    $post = Posts::getOnePostByUrl($url);
    $response->json($post);
  }


  public static function getAllPostByTag(Request $request, Response $response)
  {
    $tag = $request->params->tag;
    $page = $request->params->page;
    $posts = Posts::getAllPostByTag($tag, $page);
    $response->json($posts);
  }

  public static function getAllPostByTop(Request $request, Response $response)
  {
    $page = $request->params->page;
    $posts = Posts::getAllPostByTop($page);
    $response->json($posts);
  }


  public static function getAllPostsByUser(Request $request, Response $response)
  {
    $authorization = $request->form()->Authorization;
    $user = Auth::verify("Bearer $authorization");
    if (!$user) $response->json(null);
    $posts = Posts::getAllPostsByUser($user->dd->id);
    $response->json($posts);
  }

  /**
   * Display the specified resource.
   *
   * @param  \Http\Request  $request
   */
  public static function show(Request $request)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function update(Request $request)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public static function destroy(Request $request, Response $response)
  {
    $post_id = $request->form()->post_id;
    Posts::delete($post_id);
    $response->json("deleted");
  }
}
