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
    <div class="min-h-screen bg-gray-900">
      @include('layouts.navigation')

      <!-- Page Heading -->
      @if (isset($header))
        <header class="bg-gray-800 shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
          </div>
        </header>
      @endif

      <!-- Page Content -->
      <main>

        @if (\Route::is('boards.*'))

          <div class="py-4 sm:py-8">

            @if(session('message'))
              <div class="max-w-7xl mx-auto mb-6 sm:px-6 lg:px-8">
                <div class="bg-gray-800 p-4 text-gray-100 sm:rounded-lg">
                  {{ session('message') }}
                </div>
              </div>
            @endif

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

              @if (\Route::is('boards.create', 'boards.show', 'boards.edit'))
                <a href="{{ route('boards.index') }}" class="bg-gray-800 overflow-hidden mb-2 sm:mb-6 inline-block shadow-sm ml-4 sm:ml-0 sm:rounded-lg p-4 text-gray-100 hover:text-gray-600">戻る</a>
              @elseif (\Route::is('boards.index'))
                @auth
                  <a href="{{ route('boards.create') }}" class="bg-gray-800 overflow-hidden mb-2 sm:mb-6 inline-block shadow-sm ml-4 sm:ml-0 sm:rounded-lg p-4 text-gray-100 hover:text-gray-600">新規登録</a>
                @endauth
              @endif

              <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-gray-100">

                  {{ $slot }}

                </div>
              </div>
            </div>
          </div>

        @else

        {{ $slot }}

        @endif

      </main>
    </div>
  </body>
</html>
