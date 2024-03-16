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
                <li class="block p-2 pl-4 border-b">
                  <a href="{{ route('boards.show', ['board' => $board->id ]) }}" class="block text-gray-100 hover:text-gray-600">
                    {{ $board->title }}
                  </a>
                </li>
              @endforeach
            </ul>
          </section>
          {{ $boards->links() }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>