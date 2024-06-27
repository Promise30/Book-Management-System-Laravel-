<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        $book = Book::findOrFail($book->id);
        $reviews = $book->reviews()->paginate(10);
        return response()->json(compact("book","reviews"));
        //return view("reviews.index",compact("reviews"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        //
        //return view("reviews.create", compact("book"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Book $book, StoreReviewRequest $request)
    {
        //
        $validatedReview = $request->validated();
        //dd($validatedReview);
        $book = Book::findOrFail($book->id);
        
        $review = new Review($validatedReview);
        $review->book_id = $book->id;
        $review->user_id = auth()->user()->id;

        $book->reviews()->save($review);
        //$review->book()->associate($book);
        //$review->user()->associate(auth()->user());
        //$review->save();  
        
        return redirect()->route("book.show", $book->id)->with("success","Review created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book, Review $review)
    {
        //
        //return view("reviews.show", compact("review"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Review $review)
    {
        //
       // return view("reviews.edit", compact("review"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Book $book, UpdateReviewRequest $request, Review $review)
    {
        //
        $book = Book::findOrFail($book->id);
        $review = Review::findOrFail($review->id);
        // check if user can edit
        if($review->user_id != auth()->user()->id){
            return redirect()->back()->with("error","You cannot edit this review");
        }
        $validatedReview = $request->validated();
        $review->update($validatedReview);
        return redirect()->route("book.show", $book->id)->with("success", "Review updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Review $review)
    {
        //  
        $review = Review::findOrFail($review->id);
        if($review->user_id != auth()->user()->id){
            return redirect()->back()->with("error","You cannot delete this review");
        };
        $review->delete();
        return redirect()->route("book.show", $book->id)->with("success", "Review deleted successful");

    }
}
