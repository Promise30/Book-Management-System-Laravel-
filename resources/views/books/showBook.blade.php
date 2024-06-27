<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen overflow-hidden">
        <div class="w-full md:w-1/3 h-full flex items-center justify-center px-10">
            <div class="max-w-sm w-full h-full rounded overflow-hidden shadow-lg">
                @if($book->cover_image)
                <a href="{{ '/storage/' . $book->cover_image }}" target="_blank" class="block h-full">
                    <img class="h-50" src="{{ '/storage/' . $book->cover_image }}" alt="{{ $book->title }}">
                </a>
                @endif
            </div>
        </div>
        
        <div class="w-full md:w-2/3 h-full overflow-y-auto p-4">
            <div class="px-6 py-4">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{$book->title}}</h2>
                    
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Description</h3>
                        <p class="text-gray-600">{{$book->description}}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Author</h3>
                        <p class="text-gray-600">{{$book->author->name}}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Author Biography</h3>
                        <p class="text-gray-600">{{$book->author->biography}}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Book Categories</h3>
                        <ul class="list-disc list-inside text-gray-600">
                            @foreach($book->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
            </div>
                
            
            <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold ml-4 mr-2 mb-2">
                <a href="{{route('admin.dashboard')}}">
                    <x-secondary-button class="bg-green-600 hover:bg-green-800 text-white">
                        Back
                    </x-secondary-button>
                </a>
            </span>
            <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                <a href="{{route('book.edit', $book->id)}}">
                    <x-secondary-button class="bg-blue-600 hover:bg-blue-800 text-white">
                        Edit
                    </x-secondary-button>
                </a>
            </span>
            
            <span class="inline-block rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                <form method="POST" action="{{route('book.destroy', $book->id)}}">
                    @csrf
                    @method("DELETE")
                    <x-primary-button class="bg-red-500 hover:bg-red-600 text-white">
                        Delete
                    </x-primary-button>
                </form>
            </span>
    </div>
</x-app-layout>