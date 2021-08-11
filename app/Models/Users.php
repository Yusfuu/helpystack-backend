<?php

namespace App\Models;

use App\config\Database;

class Users extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [];



  public static function getUser($id)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT id, email, fullName, avatar, bio, twitter, created_at FROM users WHERE id = ? LIMIT 1;");
    $sth->execute([$id]);
    return $sth->fetch();
  }
}
