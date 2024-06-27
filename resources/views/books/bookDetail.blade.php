<x-app-layout>
    <div class="m-auto">
        <h2>Title: {{$book->title}}</h2>
        <p>Description: {{$book->description}}</p>
        <p>Author: {{$book->author->name}}</p>
        <p>Categories: 
            <ul class="px-3">
                @foreach($book->categories as $category)
                <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </p>
        <p></p>
        <form action="{{ route('reading.update', $book) }}" method="POST" class="space-x-2">
            @csrf
            <x-primary-button type="submit" name="status" value="read">
                {{ __('Read') }}
            </x-primary-button>
            <x-primary-button type="submit" name="status" value="currently_reading">
                {{ __('Currently Reading') }}
            </x-primary-button>
            <x-primary-button type="submit" name="status" value="want_to_read">
                {{ __('Want to Read') }}
            </x-primary-button>
        </form>
    </div>
    
    <div class="mt-2 mb-2">
        <a href="{{route('book.index')}}">
            <x-secondary-button>
                Back
            </x-secondary-button>
        </a>
    </div>
    {{-- REVIEW SECTION --}}
    <div class="mt-2 mb-2">
        <h2>Add Review</h2>
    
    <form method="POST" action="{{route('reviews.store', $book->id)}}">
        @csrf
        <div class="mt-2">
            <x-input-label for="review_text" :value="__('Review')" />
            <x-text-input id="review_text" class="block mt-1 w-full" type="text" name="review_text" autofocus />
            <x-input-error :messages="$errors->get('review_text')" class="mt-2" />
        </div>
        <a href="{{route('reviews.store', $book->id)}}">
        <x-primary-button>
            Add Review
        </x-primary-button>
    </a>
    </form>
    {{-- ALL BOOK REVIEW --}}
    <div class="mt-2">
        @foreach($book->reviews as $review)
            <div class="mb-2">
                <p>Reviewer: {{$review->user->name}}</p>
                <p>Review: {{$review->review_text}}</p>
                <p>Date Created: {{$review->created_at}}</p>
            </div>
        @endforeach
    </div>
</div>
    </x-app-layout>