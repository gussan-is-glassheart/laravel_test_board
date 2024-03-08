<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <!-- Page Content -->
      <main>
        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="p-6 text-gray-100 text-2xl font-bold mb-2">
              編集画面
            </h1>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <section class="text-gray-100 body-font p-6">
                <form method="post" action="{{ route('boards.update', ['board' => $board->id ]) }}">
                  @method('patch')
                  @csrf

                  <div class="container px-2 mx-auto">
                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                      <div class="flex flex-wrap -m-2">

                        <div class="p-2 w-full">
                          <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-400">タイトル</label>
                            <input type="text" id="title" name="title" value="{{ $board->title }}" class="w-full bg-gray-900 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          </div>
                        </div>

                        <div class="p-2 w-full">
                          <div class="relative">
                            <label for="content" class="leading-7 text-sm text-gray-400">内容</label>
                            <textarea id="content" name="content" class="w-full bg-gray-900 rounded border border-gray-700 focus:border-indigo-500 focus:bg-gray-900 focus:ring-2 focus:ring-indigo-900 h-32 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $board->content }}</textarea>
                          </div>
                        </div>

                        <div class="p-2 w-full">
                          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                        </div>

                      </div>
                    </div>
                  </div>
                </form>
              </section>

            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>