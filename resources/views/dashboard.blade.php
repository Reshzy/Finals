<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Add Post Button -->
            <div class="flex justify-end mt-4">
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Add Post
                </a>
            </div>

            <!-- Posts Section -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-4">
                        <h5 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $post->title }}</h5>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $post->body }}</p>
                    </div>
                    <div class="p-4 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex justify-between">
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- End of Posts Section -->
        </div>
    </div>
</x-app-layout>
