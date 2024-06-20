<x-app-layout>
<form method="post" action="{{route('book.store')}}">
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
    {{-- 
    <div>
    <label for="author">Author</label>
    <select id="author" name="author_id">
        <option value="">Select an author</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
        @endforeach
    </select>
    <input type="text" id="newAuthor" placeholder="Enter new author name">
</div>
    
    
    
    --}}


    <div class="mt-2">
        <x-primary-button>
            Create
        </x-primary-button>
    </div>
</form>

</x-app-layout>