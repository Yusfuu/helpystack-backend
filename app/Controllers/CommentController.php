<?php

namespace App\Controllers;

use App\Http\Middleware\Auth;
use App\Http\Request;
use App\Http\Response;
use App\Models\Comments;

class CommentController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Http\Request
   */
  public static function pagination(Request $request, Response $response)
  {
    $page = $request->params->page;
    $id = $request->params->id;
    $comments = Comments::pagination($page, $id);
    $response->json($comments);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function store(Request $request, Response $response)
  {
    $post_id = $request->form()->post_id;
    $body = $request->form()->body;
    $authorization = $request->form()->Authorization;
    $user = Auth::verify("Bearer $authorization");
    if (!$user) $response->json(null);
    $data = (object)['uid' => $user->dd->id, 'post_id' => $post_id, 'body' => $body];
    Comments::create($data);
    $response->json($data);
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
  public static function destroy(Request $request)
  {
    //
  }
}
