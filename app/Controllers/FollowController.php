<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Follow;

class FollowController extends Controller
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Http\Request  $request
   */
  public static function store(Request $request, Response $response)
  {
    $sender = $request->form()->sender;
    $receiver = $request->form()->receiver;
    $data = (object)["sender" => $sender, "receiver" => $receiver];
    Follow::create($data);
    $response->json("stared 👏");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \Http\Request  $request
   */
  public static function destroy(Request $request, Response $response)
  {
    $sender = $request->form()->sender;
    $receiver = $request->form()->receiver;
    Follow::unfollow($sender, $receiver);
    $response->json("unfollow 😢");
  }


  public static function show(Request $request, Response $response)
  {
    $sender = $request->form()->sender;
    $receiver = $request->form()->receiver;
    $count = Follow::count($sender, $receiver);
    $response->json($count);
  }
}
