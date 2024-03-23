<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          詳細画面
      </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('boards.index') }}" class="bg-gray-800 overflow-hidden mb-6 inline-block shadow-sm sm:rounded-lg p-4 text-gray-100 hover:text-gray-600">一覧ページに戻る</a>
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <section class="text-gray-100 body-font p-6">
            <div class="container px-2 mx-auto">
              <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">

                  <div class="p-2 w-full">
                    <div class="relative">
                      <label for="title" class="leading-7 text-sm text-gray-400">タイトル</label>
                      <div class="w-full border-b focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 pt-2 pb-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      {{ $board->title }}
                      </div>
                    </div>
                  </div>

                  <div class="p-2 w-full mb-6">
                    <div class="relative">
                      <label for="content" class="leading-7 text-sm text-gray-400">内容</label>
                      <div class="w-full border-b focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 pt-2 pb-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        {{ $board->content }}
                      </div>
                    </div>
                  </div>

                  @can ('viewOwnBoard', $board)
                    <form method='get' action="{{ route('boards.edit', ['board' => $board->id ]) }}">
                      <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</button>
                      </div>
                    </form>

                    <form id="delete_{{ $board->id }}" method="post" action="{{ route('boards.destroy', ['board' => $board->id ]) }}">
                    @method('delete')
                    @csrf
                      <div class="p-2 w-full">
                        <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="flex mx-auto text-white bg-pink-500 py-2 px-8 rounded text-lg focus:outline-none hover:bg-pink-600">削除</a>
                      </div>
                    </form>
                  @endcan

                </div>
              </div>
            </div>
          </section>
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