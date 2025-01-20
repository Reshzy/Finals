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
            <div class="flex justify-between mt-4">
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Add Post
                </a>

                <!-- Sorting Options -->
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center">
                    <label for="sort" class="mr-2 text-sm text-gray-700 dark:text-gray-300">Sort by:</label>
                    <select name="sort" id="sort" class="mr-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="created_at" {{ $sortField == 'created_at' ? 'selected' : '' }}>Date</option>
                        <option value="title" {{ $sortField == 'title' ? 'selected' : '' }}>Title</option>
                    </select>
                    <select name="direction" id="direction" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="asc" {{ $sortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $sortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                    <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Sort
                    </button>
                </form>
            </div>

            <!-- Posts Section -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                    <a href="{{ route('posts.show', $post->id) }}" class="block flex-grow">
                        <div class="p-4">
                            <h5 class="text-2xl font-extrabold text-gray-800 dark:text-gray-200">{{ $post->title }}</h5>
                            <div class="flex justify-between mt-1 text-sm text-gray-500 dark:text-gray-400">
                                <span>Posted by: {{ $post->user->name }}</span>
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="mt-4 text-gray-600 dark:text-gray-400 truncate-text">{!! $post->body !!}</div>
                        </div>
                    </a>
                    <div class="p-4 border-t border-gray-200 dark:border-gray-600 mt-auto">
                        <div class="flex justify-between">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-600">View</a>
                            @if (Auth::id() === $post->user->id)
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">Delete</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- End of Posts Section -->

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <style>
        .truncate-text {
            max-height: 100px;
            overflow: hidden;
            position: relative;
        }

        .truncate-text::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;

            background: linear-gradient(to bottom, rgba(55, 65, 81, 0), rgba(255, 255, 255, 1));
            z-index: 1;
        }

        .dark .truncate-text::after {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(55, 65, 81, 1));
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.truncate-text').forEach(function(element) {
                if (element.scrollHeight <= element.clientHeight) {
                    element.classList.remove('truncate-text');
                }
            });
        });
    </script>
</x-app-layout>