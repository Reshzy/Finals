<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $post->title }}</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Posted by: {{ $post->user->name }}</p>
                    <div class="mt-4 text-gray-600 dark:text-gray-400">{!! $post->body !!}</div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">Comments</h4>

                    @foreach ($post->comments as $comment)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->user->name }} said:</p>
                            <p class="text-gray-600 dark:text-gray-300">{{ $comment->body }}</p>
                        </div>
                    @endforeach

                    @auth
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" class="mt-6">
                            @csrf
                            <textarea name="body" rows="3" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add a comment..." required></textarea>
                            <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Post Comment
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 