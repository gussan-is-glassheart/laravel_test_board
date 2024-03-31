<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
  use HasFactory;

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * ユーザーが作成したコメントを取得
   */
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  protected $fillable = [
    'title',
    'content',
    'user_id'
  ];
}
