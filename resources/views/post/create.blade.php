<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="my-5">
            @foreach ($errors->all as $error)
                <span class="block text-red-500">{{ $error }}</span>
            @endforeach
        </div>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="w-full my-10">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <x-label for="title" value="Titre du post" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
    
                    <x-input id="title" name="title" type="text" value="{{ old('title') }}"
                    class="bg-gray-200 transition-colors appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" />

                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <x-label for="image" value="Image du post" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
    
                    <x-input id="image" name="image" type="file"
                    class="bg-gray-200 transition-colors appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" />

                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <x-label for="category" value="Category du post" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
    
                    <select name="category" id="category" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-200 transition-colors appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <x-label for="content" value="Contenu du post" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" />
    
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="10" 
                        class="bg-gray-200 transition-colors appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" >{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <x-button>Créer mon post</x-button>
            </div>
            
        </form>

    </div>
    
</x-app-layout>
