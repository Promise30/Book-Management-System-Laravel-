{{-- @extends('layouts.app') --}}
<x-app-layout>
{{-- @section('content') --}}
    <h2>Read Books</h2>
    @foreach($readBooks as $book)
        <div>
            <h3>{{ $book->title }}</h3>
            <!-- Add more book details here -->
            <form action="{{ route('reading.update', $book) }}" method="POST">
                @csrf
                
                <x-primary-button type="submit" name="status" value="currently_reading">
                    {{ __('Move to Currently Reading') }}
                </x-primary-button>
                <x-primary-button type="submit" name="status" value="want_to_read">
                    {{ __('Move to Want to Read') }}
                </x-primary-button>
            
            </form>
        </div>
    @endforeach

    <h2>Currently Reading</h2>
    @foreach($currentlyReadingBooks as $book)
        <div>
            <h3>{{ $book->title }}</h3>
            <!-- Add more book details here -->
            <form action="{{ route('reading.update', $book) }}" method="POST">
                @csrf
                {{-- <button type="submit" name="status" value="read">Move to Read</button>
                <button type="submit" name="status" value="want_to_read">Move to Want to Read</button>
                 --}}
                <x-primary-button type="submit" name="status" value="read">
                    {{ __('Move to Read') }}
                </x-primary-button>
              
                <x-primary-button type="submit" name="status" value="want_to_read">
                    {{ __('Move to Want to Read') }}
                </x-primary-button>
            </form>
        </div>
    @endforeach

    <h2>Want to Read</h2>
    @foreach($wantToReadBooks as $book)
        <div>
            <h3>{{ $book->title }}</h3>
            <!-- Add more book details here -->
            <form action="{{ route('reading.update', $book) }}" method="POST">
                @csrf
                {{-- <button type="submit" name="status" value="read">Move to Read</button>
                <button type="submit" name="status" value="currently_reading">Move to Currently Reading</button> --}}
                <x-primary-button type="submit" name="status" value="read">
                    {{ __('Move to Read') }}
                </x-primary-button>
                <x-primary-button type="submit" name="status" value="currently_reading">
                    {{ __('Move to Currently Reading') }}
                </x-primary-button>
           
            </form>
        </div>
    @endforeach
{{-- @endsection --}}
</x-app-layout>