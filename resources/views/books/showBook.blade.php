<x-app-layout>
<div class="m-auto">
    <h2>Title: {{$book->title}}</h2>
    <p>Description: {{$book->description}}</p>
    <p>Author: {{$book->author->name}}</p>
    <p>Categories: 
        <ul class="px-3"
            @foreach($book->categories as $category)
            <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    </p>
    <p></p>
</div>

<div class="mt-2 mb-2">
    <a href="{{route('book.index')}}">
        <x-secondary-button>
            Back
        </x-secondary-button>
    </a>
</div>
<div class="mt-2 mb-2">
    <a href="{{route('book.edit', $book->id)}}">
        <x-secondary-button>
            Edit
        </x-secondary-button>
    </a>
</div>
<form method="POST" action="{{route('book.destroy', $book->id)}}">
    @csrf
    @method("DELETE")
    <x-primary-button>
        Delete
    </x-primary-button>
    </form>
</x-app-layout>