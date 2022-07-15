<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <img 
            class="object-cover h-auto w-full rounded-lg"
            src="{{ asset('storage/' . $post->image) }}" alt="Image de l'article : {{ $post->title }}">

        <main class="py-5">
            {{ $post->content }}
        </main>
    </div>
</x-app-layout>