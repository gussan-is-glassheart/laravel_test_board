<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      新規掲示板作成
    </h2>
  </x-slot>

  <section class="text-gray-100 body-font p-6">
    <form method="post" action="{{ route('boards.store') }}">
      @csrf

      <div class="container px-2 mx-auto">
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
          <div class="flex flex-wrap -m-2">

            <div class="p-2 w-full">
              <div class="relative">
                <label for="title" class="leading-7 text-sm text-gray-400">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-gray-900 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
              </div>
            </div>

            <div class="p-2 w-full">
              <div class="relative">
                <label for="content" class="leading-7 text-sm text-gray-400">内容</label>
                <textarea id="content" name="content" class="w-full bg-gray-900 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 h-32 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
              </div>
            </div>

            <div class="p-2 w-full">
              <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </section>

</x-app-layout>