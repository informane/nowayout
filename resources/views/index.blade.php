<x-blog-layout>

                <div class="m-8 bg-white dark:bg-gray-800 overflow-hidden">
                    <div class="rounded p-6">
                        @auth
                            @if (Auth::user()->can('create',\App\Models\Post::class))
                        <div class="m-4 text-lg leading-7 font-semibold">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            <a href="/create-post" class="underline text-gray-900 dark:text-white">
                                Create post
                            </a>
                            </div>
                        </div>
                            @endif
                        @endauth
                    </div>
                    @if(count($posts))
                            @foreach($posts as $post)
                            <div class="rounded p-6 border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    <div class="">{{date('d.m.Y H:i:s', strtotime($post->created_at))}}</div>
                                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="/view-post/{{$post->id}}" class="underline text-gray-900 dark:text-white">{{$post->title}}</a></div>
                                </div>
                                @auth
                                @if (Auth::user()->can('update', $post))
                                    <x-nav-link href="/edit-post/{{$post->id}}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Edit</x-nav-link>
                                @endif
                                @if (Auth::user()->can('update', $post))
                                    <x-nav-link href="/delete-post/{{$post->id}}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Remove</x-nav-link>
                                @endif
                                @endauth
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div>No posts are published</div>
                    @endif
                </div>

</x-blog-layout>
