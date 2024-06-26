<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use App\Models\Comment;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;

class BoardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user = Auth::user();
    $boards = Board::query();

    // キーワードから検索処理
    $keyword = $request->input('keyword');
    if(!empty($keyword)) { //keywordが空ではない場合、検索処理を実行します
      $boards->where('title', 'LIKE', "%{$keyword}%");
    }

    // ソート(作成順)、ページネーション
    $boards = $boards->orderBy('created_at', 'desc')
    ->paginate(10);

    return view('boards.index', compact('user','boards'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('boards.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreBoardRequest $request)
  {
    $user = Auth::user();

    Board::create([
      'user_id' => $user->id,
      'title' => $request->title,
      'content' => $request->content,
    ]);

    session()->flash('message', '掲示板を作成しました');

    return to_route('boards.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = Auth::user();
    $board = Board::find($id);

    return view('boards.show', compact('user','board'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $board = Board::find($id);

    if ($board->user_id !== auth()->id()){
      return redirect()->route('boards.index');
    }
    return view('boards.edit', compact('board'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateBoardRequest $request, $id)
  {
    $board = Board::find($id);
    $board->title = $request->title;
    $board->content = $request->content;
    $this->authorize('update', $board);
    $board->update();

    session()->flash('message', '掲示板を更新しました');

    return to_route('boards.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $board = Board::find($id);
    $this->authorize('delete', $board);
    $board->delete();

    session()->flash('message', '掲示板を削除しました');

    return to_route('boards.index');
  }
}
