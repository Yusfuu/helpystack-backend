<?php

namespace App\Models;

use App\config\Database;

class Follow extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [];

  public static function count($sender, $receiver)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT COUNT(*) as isFollow FROM follow WHERE follow.sender = $sender AND follow.receiver = $receiver");
    $sth->execute();
    return $sth->fetch();
  }

  public static function unfollow($sender, $receiver)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("DELETE FROM follow WHERE follow.sender = $sender AND follow.receiver = $receiver");
    $sth->execute();
  }
}
