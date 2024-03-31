<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          詳細画面
      </h2>
  </x-slot>

  <section class="text-gray-100 body-font p-6">
    <div class="container px-2 mx-auto mb-10">
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
    <div class="mx-auto">
      <div class=" flex justify-between mb-6 border-b px-2">
        <h3 class="pb-1">コメント</h3>
        <p>{{ $board->comments()->count() }} 件</p>
      </div>
      <ul class="my-8">
        @foreach($board->comments as $comment)
          <li class="py-1 border-b text-sm text-gray-300 mx-4 my-2 px-2 border-gray-500">{{ $comment->body }}</li>
        @endforeach
      </ul>
    </div>
    <div class="mx-auto">
      <form method="post" action="{{ route('comments.store') }}">
        @csrf
        <input type="hidden" name='board_id' value="{{ $board->id }}">
        <div class="p-2 w-full">
          <div class="relative">
            <textarea id="body" name="body" class="w-full bg-gray-900 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 h-16 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('body') }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-1" />
          </div>
          <div class="p-2 w-full">
            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">コメントする</button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <script>
    function deletePost(e){
      'use strict'
      if(confirm('本当に削除しますか？')){
        document.getElementById('delete_' + e.dataset.id).submit()
      }
    }
  </script>
</x-app-layout>