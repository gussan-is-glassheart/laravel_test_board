<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
      掲示板一覧
    </h2>
  </x-slot>

  <section class="text-gray-100 body-font mb-4 sm:p-6 sm:pt-2">
    <ul class="sm:px-8">
      <div class="mb-6 flex">
        <form action="{{ route('boards.index') }}" method="GET">
          @csrf
          <input type="text" name="keyword" class="text-gray-600 p-1" placeholder="タイトルで検索">
          <input type="submit" value="検索" class="text-white border ml-1 px-2 py-1 hover:bg-white hover:text-gray-600">
        </form>
        <a href="{{ route('boards.index') }}" class="border px-2 py-1 ml-2 bg-white text-gray-600 hover:bg-gray-700 hover:text-white">クリア</a>
      </div>
      @foreach($boards as $board)
        <li class="py-2 pl-4 border-b sm:flex sm:justify-between">
          <div>
            <span class="block text-xs text-gray-300">
              <span class="block mb-1 sm:inline-block sm:mb-0">作成者：{{ $board->user->name }}</span>
              <span class="sm:ml-2">最終更新日時：{{ $board->updated_at->diffForHumans() }}</span>

              @if ($board->comments->isNotEmpty())
                <span class="ml-2">最終コメント日時：{{ $board->comments->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}</span>
              @endif

            </span>
            <a href="{{ route('boards.show', ['board' => $board->id ]) }}" class="inline-block text-gray-100 hover:text-gray-600 font-black py-2">
              {{ $board->title }}
            </a>
          </div>
          @auth
            @can ('viewOwnBoard', $board)
              <div class="mb-2 mt-3 flex items-center">
                <form class="inline-block" method='get' action="{{ route('boards.edit', ['board' => $board->id ]) }}">
                  <button class="inline-block mr-3 px-3 py-1 text-white bg-indigo-500 rounded  hover:bg-indigo-600">編集</button>
                </form>

                <form class="inline-block" id="delete_{{ $board->id }}" method="post" action="{{ route('boards.destroy', ['board' => $board->id ]) }}">
                @method('delete')
                @csrf
                  <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="inline-block mr-3 px-3 py-1 text-white bg-pink-500 rounded hover:bg-pink-600">削除</a>
                </form>
              </div>
            @endcan
          @endauth
        </li>
      @endforeach
    </ul>
  </section>
  {{ $boards->links() }}

  <script>
    function deletePost(e){
      'use strict'
      if(confirm('本当に削除しますか？')){
        document.getElementById('delete_' + e.dataset.id).submit()
      }
    }
  </script>
</x-app-layout>