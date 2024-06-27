<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-dark text-lg font-bold">Add New Book</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
<form method="post" action="{{route('book.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="mt-2">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" autofocus />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <div class="mt-2">
        <x-input-label for="description" :value="__('Description')" />
        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" autofocus />
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <div class="mt-2">
        <x-input-label for="cover_image" :value="__('Image (if any)')" />
        <x-file_input name="cover_image" id="cover_image" />
        <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
    </div>
    <div class="mt-2">
        <x-input-label for="author" :value="__('Author')" />
        <select id="author" name="author_id">
            <option value="">Select an author</option>
            @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('author')" class="mt-2" />
    </div>
    <div class="mt-2">
        <x-input-label for="categories" :value="__('Categories')" />
        @foreach($categories as $category)
            <div>
                <input type="checkbox" id="category{{$category->id}}" name="categories[]" value="{{$category->id}}">
                <label for="category{{$category->id}}">{{$category->name}}</label>
            </div>
        @endforeach
    </div>
    
    
    

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('admin.dashboard') }}" class="mr-4">
            <x-secondary-button>Back</x-secondary-button>
        </a>
        <x-primary-button class="ml-3">
            Create
        </x-primary-button>
    </div>

</div>
</div>
</x-app-layout>