<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with("categories")->get();
        return view("books.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(["id","name"]);
        $authors = Author::get(["id", "name"]);
        return view("books.createBook", compact("authors", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validatedData =$request->validated();
        $book = Book::create($validatedData);
        $book->categories()->attach($validatedData["categories"]); 
        return redirect()->route("book.index")->with("success","Book created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //$book = $book->with("categories")->findOrFail($book->id);
        return view("books.showBook", compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::get(["id","name"]);
        $authors = Author::get(["id", "name"]);
        return view("books.editBook", compact("book", "categories", "authors"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validatedData = $request->validated();
        $book->update($validatedData);
        if( $book->categories()->count() > 0){
            //$book->categories()->sync($validatedData->categories);
            $book->categories()->attach($validatedData["categories"]); 

        }
        return redirect()->route("book.show",$book->id)->with("success","Book updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book = Book::findOrFail($book->id);
        $book->categories()->detach();
        $book->delete();
        return redirect()->route("book.index")->with("success","Book deleted successfully");
    }
}
