<?php

namespace App\Models;

use App\config\Database;

class Comments extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [];
  public static function pagination($offset, $post_id)
  {
    $page = ($offset * 8) - 8;
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT users.fullName, users.avatar, users.id, comments.body,comments.created_at
    from users 
    inner join comments on comments.uid = users.id
    where comments.post_id = $post_id ORDER BY created_at DESC
    LIMIT $page , 8;
    ");
    $sth->execute();
    return $sth->fetchAll();
  }
}
