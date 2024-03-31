<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $inputs = request()->validate([
      'body' => 'required|max:255',
    ]);

    $comment = Comment::create([
      'body' => $inputs['body'],
      'user_id' => auth()->user()->id,
      'board_id' => $request->board_id
    ]);

    return back();
  }

}
