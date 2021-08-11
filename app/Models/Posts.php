<?php

namespace App\Models;

use App\config\Database;

class Posts extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [];

  public static function pagination($offset)
  {
    $page = ($offset * 8) - 8;
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT 
    p.id as post_id, 
    p.uid, 
    p.background, 
    p.code, 
    p.description, 
    p.lang, 
    p.color, 
    p.tags, 
    p.name,
    p.url,
    p.created_at, 
    u.email, 
    u.fullName,
    u.avatar, 
    COALESCE(likes.LikeCNT, 0) AS likeCount,
    COALESCE(comments.CommentCNT, 0) AS commentCount 
  FROM 
    posts p 
    INNER JOIN users u ON p.uid = u.id 
    LEFT JOIN (
      SELECT 
        COUNT(likes.post_id) LikeCNT, 
        likes.post_id 
      FROM 
        likes 
      GROUP BY 
        likes.post_id
    ) likes on likes.post_id = p.id 
    LEFT JOIN(
    SELECT
        COUNT(comments.post_id) CommentCNT,
        comments.post_id
    FROM
        comments
    GROUP BY
        comments.post_id
  ) comments
  ON
    comments.post_id = p.id
  ORDER BY 
    created_at DESC
    LIMIT $page , 8;
  ");
    $sth->execute();
    return $sth->fetchAll();
  }

  public static function getOnePostByUrl($url = null)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT
    p.id AS post_id,
    p.uid,
    p.background,
    p.code,
    p.description,
    p.lang,
    p.color,
    p.tags,
    p.name,
    p.url,
    p.created_at,
    u.email,
    u.fullName,
    u.avatar,
    COALESCE(likes.LikeCNT, 0) AS likeCount,
    COALESCE(comments.CommentCNT, 0) AS commentCount
    FROM
    posts p
    INNER JOIN users u ON
    p.uid = u.id
    LEFT JOIN(
    SELECT
        COUNT(likes.post_id) LikeCNT,
        likes.post_id
    FROM
        likes
    GROUP BY
        likes.post_id
      ) likes
    ON
    likes.post_id = p.id
    LEFT JOIN(
    SELECT
        COUNT(comments.post_id) CommentCNT,
        comments.post_id
    FROM
        comments
    GROUP BY
        comments.post_id
    ) comments
    ON
    comments.post_id = p.id
    WHERE
    p.url = '$url'");
    $sth->execute();
    return $sth->fetch();
  }



  public static function getAllPostByTag($tag = null, $page)
  {
    $page = ($page * 8) - 8;
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT p.id AS post_id, p.uid, p.background, p.code, p.description, p.lang, p.color, p.tags, p.name, p.url, p.created_at, u.email, u.fullName, u.avatar, COALESCE(likes.LikeCNT, 0) AS likeCount, COALESCE(comments.CommentCNT, 0) AS commentCount FROM posts p INNER JOIN users u ON p.uid = u.id LEFT JOIN( SELECT COUNT(likes.post_id) LikeCNT, likes.post_id FROM likes GROUP BY likes.post_id ) likes ON likes.post_id = p.id LEFT JOIN( SELECT COUNT(comments.post_id) CommentCNT, comments.post_id FROM comments GROUP BY comments.post_id ) comments ON comments.post_id = p.id WHERE p.tags LIKE '%$tag%' ORDER BY created_at DESC LIMIT $page,8;");
    $sth->execute();
    return $sth->fetchAll();
  }

  public static function getAllPostByTop($page)
  {
    $page = ($page * 8) - 8;
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT p.id AS post_id, p.uid, p.background, p.code, p.description, p.lang, p.color, p.tags, p.name, p.url, p.created_at, u.email, u.fullName, u.avatar, COALESCE(likes.LikeCNT, 0) AS likeCount, COALESCE(comments.CommentCNT, 0) AS commentCount FROM posts p INNER JOIN users u ON p.uid = u.id LEFT JOIN( SELECT COUNT(likes.post_id) LikeCNT, likes.post_id FROM likes GROUP BY likes.post_id ) likes ON likes.post_id = p.id LEFT JOIN( SELECT COUNT(comments.post_id) CommentCNT, comments.post_id FROM comments GROUP BY comments.post_id ) comments ON comments.post_id = p.id ORDER BY LikeCNT DESC LIMIT $page,8;");
    $sth->execute();
    return $sth->fetchAll();
  }



  public static function getAllPostsByUser($uid)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT p.id AS post_id, p.uid, p.description, p.tags, p.name, p.url, p.created_at, COALESCE(likes.LikeCNT, 0) AS likeCount, COALESCE(comments.CommentCNT, 0) AS commentCount FROM posts p INNER JOIN users u ON p.uid = u.id LEFT JOIN( SELECT COUNT(likes.post_id) LikeCNT, likes.post_id FROM likes GROUP BY likes.post_id ) likes ON likes.post_id = p.id LEFT JOIN( SELECT COUNT(comments.post_id) CommentCNT, comments.post_id FROM comments GROUP BY comments.post_id ) comments ON comments.post_id = p.id WHERE p.uid = $uid ORDER BY LikeCNT DESC");
    $sth->execute();
    return $sth->fetchAll();
  }
}
