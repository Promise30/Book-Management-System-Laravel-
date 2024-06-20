<x-app-layout>
    <div class="mx-4 my-4 px-10">
    <div class="mb-4">
        <a href="{{route('book.create')}}">
            <x-secondary-button>
                Add New book
            </x-secondary-button>
        </a>
    </div>
    @foreach ($books as $book)
        <h2>Title: {{$book->title}}</h2>
        <p>Description: {{$book->description}}</p>
        <p>Author: {{$book->author->name}}</p>
        <p>Category:
            <ul class="px-4">
                @foreach($book->categories as $category)
                <li>{{ $category->name }}</li>
                @endforeach
            </ul>    
        </p>
        <a href="{{route('book.show', $book->id)}}" class="mb-3">
            <x-secondary-button>Show More</x-secondary-button>
        </a>
        <br><hr  class="border-4 ">
        
    @endforeach
</div>
   
</x-app-layout>