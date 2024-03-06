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
              掲示板一覧
            </h1>
            <div class="mb-6 ml-4">
              <a href="{{ route('boards.create') }}" class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 text-gray-100 hover:text-gray-600">新規登録</a>
            </div>

            <ul class="px-8">
              @foreach($boards as $board)
                <li class="block p-2 pl-4 border-b">
                  <a href="{{ route('boards.show', ['board' => $board->id ]) }}" class="block text-gray-100 hover:text-gray-600">
                    {{ $board->title }}
                  </a>
                </li>
              @endforeach
            </ul>

          </div>
        </div>
      </main>
    </div>
  </body>
</html>