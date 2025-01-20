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
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $comment->user->name }} said on {{ $comment->created_at->format('m/d/Y g:i A') }}:
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">{{ $comment->body }}</p>
                        </div>
                    @endforeach

                    @auth
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" class="mt-6">
                            @csrf
                            <div class="mb-4">
                                <textarea name="body" rows="3" class="w-full rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" placeholder="Add a comment..." required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 