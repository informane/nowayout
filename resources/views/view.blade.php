<x-blog-layout>
    <x-nav-link href="{{ route('index') }}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Back</x-nav-link>
    @auth
    @if (Auth::user()->can('update', $post))
        <x-nav-link href="/edit-post/{{$post->id}}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Edit</x-nav-link>
    @endif
    @if (Auth::user()->can('update', $post))
        <x-nav-link href="/delete-post/{{$post->id}}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Remove</x-nav-link>
    @endif
    @endauth
    <div class="p-6">

        <h1 class='text-xl mb-7'>{{$post->title}}</h1>
        <p class="p-7 border rounded">
            {{$post->text}}
        </p>
    </div>
</x-blog-layout>
