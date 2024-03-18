<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      掲示板一覧
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('boards.create') }}" class="bg-gray-800 overflow-hidden mb-6 inline-block shadow-sm sm:rounded-lg p-4 text-gray-100 hover:text-gray-600">新規登録</a>
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <section class="text-gray-100 body-font p-6 pt-2 mb-4">
            <ul class="px-8">
              @foreach($boards as $board)
                <li class="flex justify-between py-2 pl-4 border-b">
                  <a href="{{ route('boards.show', ['board' => $board->id ]) }}" class="inline-block text-gray-100 hover:text-gray-600 py-1">
                    {{ $board->title }}
                  </a>
                  @can ('viewOwnBoard', $board)
                    <div class="flex">
                      <form method='get' action="{{ route('boards.edit', ['board' => $board->id ]) }}">
                        <button class="mr-3 inline-block px-3 py-1 text-white bg-indigo-500 rounded  hover:bg-indigo-600">編集</button>
                      </form>

                      <form id="delete_{{ $board->id }}" method="post" action="{{ route('boards.destroy', ['board' => $board->id ]) }}">
                      @method('delete')
                      @csrf
                        <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="mr-3 inline-block px-3 py-1 text-white bg-pink-500 rounded hover:bg-pink-600">削除</a>
                      </form>
                    </div>
                  @endcan
                </li>
              @endforeach
            </ul>
          </section>
          {{ $boards->links() }}
        </div>
      </div>
    </div>
  </div>
  <script>
    function deletePost(e){
      'use strict'
      if(confirm('本当に削除しますか？')){
        document.getElementById('delete_' + e.dataset.id).submit()
      }
    }
  </script>
</x-app-layout>