<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateReadingStatusRequest;

class ReadingStatusController extends Controller
{
    //
    public function update(UpdateReadingStatusRequest $request, Book $book)
    {
        $validated = $request->validated();
        auth()->user()->books()->syncWithoutDetaching([$book->id => ['status' =>$validated["status"]]]);
        return back()->with("success","Reading status updated");
        // redirect()->route("book.show", $book->id)
    }
    public function dashboard()
    {
        $user = auth()->user();
        $readBooks = $user->books()->wherePivot('status', 'read')->get();
        //dd($readBooks);
        $currentlyReadingBooks = $user->books()->wherePivot('status', 'currently_reading')->get();
        $wantToReadBooks = $user->books()->wherePivot('status', 'want_to_read')->get();

        return view("books.readingDashboard", compact('readBooks', 'currentlyReadingBooks', 'wantToReadBooks'));
    }


}
