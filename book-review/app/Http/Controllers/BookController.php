<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        // input('filter', '') >> if filter is not set then it will be empty
        $filter = $request->input('filter', '');
        
        // when >> if $title is not null then the func() will be called, else do nothing
        // this will be use in <form> in index.blade.php to search for a book.
        $books = Book::when(
            $title,
            // $query is the instance of the query builder
            // $title is the value of the title
            // $query->title($title) is the function that will be called from Book.php->scopeTitle()
            fn ($query, $title) => $query->title($title)
        );

        // match() statement is a shorthand for switch statement
        // the result of the match statement will be assigned to $books
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6month' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6month' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };
        // Cache::remember('key', how long we wanna store this data, fn() closer/lambda that will be executed if the data is not in the cache);
        // Cache::remember('books', 3600, fn() => $books->get());
        
        // 'books' key doesn't reflect the parameters ($title, $filter)
        // BE CAREFUL with sensitive data in cache, it will show in the diff users
        $cacheKey = 'books:' . $filter . ':' . $title;
        $books = cache()->remember($cacheKey, 3600, fn() => $books);
        
        // ['books' => $books] same as compact('books') >> find a variable with the name books and turn it into an array
        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cacheKey ='book:' . $id;

        $book = cache()->remember(
            $cacheKey,
            3600,
            fn() => Book::with([
            // all the 'reviews' that we see will be sort by latest and take only 3 reviews
            'reviews' => fn($query) => $query->latest()->take(3)
            ])->withAvgRating()->withReviewsCount()->findOrFail($id)
        );

        // when we get inside this method the $book is already loaded from DB
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
