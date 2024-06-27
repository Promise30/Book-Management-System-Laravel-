{{-- <x-app-layout>
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
        <a href="{{route('admin.show', $book->id)}}" class="mb-3">
            <x-secondary-button>Show More</x-secondary-button>
        </a>
        <br><hr  class="border-4 ">
        
    @endforeach
</div>
   
</x-app-layout> --}}
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <a href="{{ route('book.create') }}">
                <x-secondary-button class="bg-green-500 hover:bg-green-600 text-white">
                    Add New Book
                </x-secondary-button>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($book->cover_image)
                        <img src="{{ '/storage/' . $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2 truncate">{{ $book->title }}</h2>
                        <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $book->description }}</p>
                        <p class="text-gray-700 text-sm mb-2">Author: {{ $book->author->name }}</p>
                        <div class="mb-4">
                            <p class="text-gray-700 text-sm mb-1">Categories:</p>
                            <div class="flex flex-wrap">
                                @foreach($book->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('admin.show', $book->id) }}" class="block text-center">
                            <x-secondary-button class="w-full bg-blue-500 hover:bg-blue-600 text-white">
                                Show More
                            </x-secondary-button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>