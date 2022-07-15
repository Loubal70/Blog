<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="overflow-x-hidden bg-gray-100">

        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full lg:w-8/12">
                    @foreach ($posts as $post)
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between">
                                <span class="font-light text-gray-600">
                                    {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                                </span>
                                <a href="#"
                                    class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                                    {{ $post->title }}
                                </a>
                                <p class="mt-2 text-gray-600">
                                    {{ Str::limit($post->content, 120) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="{{ route('posts.show', $post) }}"
                                    class="text-blue-500 hover:underline">Voir plus</a>
                                <div>
                                    <a href="{{ route('posts.show', $post) }}" class="flex items-center">
                                        <h1 class="font-bold text-gray-700 hover:underline">{{ $post->user->name }}</h1>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-8">
                        <div class="flex">
                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-500 bg-white rounded-md cursor-not-allowed">
                                previous
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                1
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                2
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                3
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
                @include('partials.sidebar')
            </div>
        </div>
        @include('partials.footer')
    </div>

    
</x-app-layout>
