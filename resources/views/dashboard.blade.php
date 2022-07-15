<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-yellow-900 text-center py-4 lg:px-4">
                    <a href="{{ route('posts.create') }}" class="p-2 bg-yellow-800 items-center text-yellow-100 leading-none rounded-full flex inline-flex" role="alert">
                      <span class="flex rounded-full bg-yellow-500 uppercase px-2 py-1 text-xs font-bold mr-3">Nouveau</span>
                      <span class="font-semibold mr-2 text-center md:text-left flex-auto">Vous avez la possibilité de créer de nouveaux articles !</span>
                      <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                    </a>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                          <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                          <div>
                            <p class="font-bold">{{ session('success') }}</p>
                            <p class="text-sm">Il ne vous reste plus qu'à le partager à votre communauté !</p>
                          </div>
                        </div>
                      </div>
                    @endif
                </div>

                @foreach ($posts as $post)
                    <div class="flex items-center pl-5">{{ $post->title }}
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 px-2 py-3 block ml-auto text-white font-semibold">Editer {{ $post->title }}</a>
                        <a href="" class="bg-red-500 px-2 py-3 block text-white font-semibold"
                            onclick="event.preventDefault(); document.querySelector('#destroy-post-form').submit();">Supprimer {{ $post->title }}</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="post" id="destroy-post-form">
                                @csrf
                                @method('DELETE')
                            </form>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
