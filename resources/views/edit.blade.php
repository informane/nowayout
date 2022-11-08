<x-blog-layout>
    <x-nav-link href="{{ route('index') }}" class="block mx-6 mt-3 mb-1 text-sm text-gray-700 dark:text-gray-500 underline">Home</x-nav-link>
    <div class="p-6">
        <h1 class='text-xl'>Edit blog</h1>
        <form method="POST" class="post_form" action=@if(isset($post->id))"/update-post"@else"/store-post"@endif enctype="multipart/form-data">
            @csrf
            @isset($post->id)<input type="hidden" value="{{ $post->id }}" name="id" id="id">@endisset
            <div class="items-center">
                <x-input-label for="title" value="Title" />
                <x-text-input value="{{$post->title}}" type="text" id="title" name="title" class="block mt-1 w-full @error('title') is-invalid @enderror"/>

                <div class="alert alert-danger"></div>

            </div>

            <div class="items-center mt-5">
                <x-input-label for="text" value="Text" />
                <x-text-area rows="20" value="{{$post->text}}" type="text" id="text" name="text" class="block mt-1 w-full @error('text') is-invalid @enderror">
                    {{$post->text}}
                </x-text-area>
                <div class="alert alert-danger"></div>
            </div>

            <div class="items-center">
                <x-primary-button class="mt-5 post_submit">
                    Save
                </x-primary-button>
            </div>
        </form>
    </div>
    <script type="module">

    </script>
</x-blog-layout>
