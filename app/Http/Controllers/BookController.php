<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with("categories")->get();
        // return view("books.index", compact("books"));
        return view("books.userDashboard", compact("books"));
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
        // if($request->file('cover_image')){
        //     $extension = $request->file('cover_image')->extension();
        //     $contents = file_get_contents($request->file('cover_image'));
        //     $filename = Str::random(25);
        //     $path = "books/$filename.$extension";
        //     Storage::disk('public')->put($path, $contents);
        //     $validated['cover_image'] = $path;
        // }
        
        
        if ($request->hasFile('cover_image')) {
            // Store the file in the public disk under the books directory
            $path = $request->file('cover_image')->store('books', 'public');
            
            // Update the validated data with the correct path
            $validatedData['cover_image'] = $path;
        }

        $book = Book::create($validatedData);
        $book->categories()->attach($validatedData["categories"]); 
        return redirect()->route("admin.dashboard")->with("success","Book created successfully");
    }

    /**
     * Display the specified resource.
     */
    // public function showBook(Book $book)
    // {
    //     //$book = $book->with("categories")->findOrFail($book->id);
    //     $book->load("reviews");
    //     return view("books.bookDetail", compact("book"));
    //    // return view("books.showBook", compact("book"));
    // }
    public function show(Book $book)
    {
        //$book = $book->with("categories")->findOrFail($book->id);
        $book->load("reviews");
        return view("books.bookDetail", compact("book"));
       // return view("books.showBook", compact("book"));
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

        // Handle categories
        $categories = $validatedData['categories'] ?? [];
        unset($validatedData['categories']);

        // Handle cover image
        // if($request->file('cover_image')) {
        //         Storage::disk('public')->delete($book->cover_image);
        //         $extension = $request->file('cover_image')->extension();
        //         $contents = file_get_contents($request->file('cover_image'));
        //         $filename = Str::random(25);
        //         $path = "books/$filename.$extension";
        //         Storage::disk('public')->put($path, $contents);
        //         $book->update(['cover_image' => $path]);
        //     }
        if ($request->hasFile('cover_image')) {
            // Delete old image if it exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('books', 'public');
            $validatedData['cover_image'] = $path;
        }

        // Update book details
        $book->update($validatedData);

        // Sync categories
        $book->categories()->sync($categories);
        return redirect()->route("admin.show",$book->id)->with("success","Book updated successfully");
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
        return redirect()->route("admin.dashboard")->with("success","Book deleted successfully");
    }
}
