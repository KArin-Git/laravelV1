@extends('layouts.app')
@section('content')
    <h1 class="mb-10 text-2x1">Books</h1>

    {{-- Section: Search by Title --}}
    {{-- everything in the form (GET) will be passed as a query parameter ** useful w/filter ** --}}
    <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center space-x-2">
        {{-- value="{{ request('title') }}" if we have seearched something before, it will appear here --}}
        <input type="text" name="title" value="{{ request('title') }}" class="input h-10" placeholder="Search by Title">
        {{-- input:hidden >> you cannot see it but you can pass it as an input which is value="{{ request('filter') }}" ** will be used in line 33--}}
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button type="submit" class="btn h-10">Search</button>
        {{-- clear the form --}}
        <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
    </form>

    {{-- Section: Filter by Rating --}}
    <div class="filter-container mb-4 flex">
        {{-- define the filters contain 'keys' which would represent what needs to be passed to the $query parameter to the $request --}}
        @php
            $filters = [
                // 'key' => 'label'
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6month' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest rated Last Month',
                'highest_rated_last_6month' => 'Highest rated Last 6 Months',
            ];
        @endphp
        @foreach ($filters as $key => $label)
        {{-- 'filter' => $key array of all parameters we passed --}}
        {{-- request()->query() all the array of parameters we have --}}
        {{-- ... >> unpack the array (request()->query()) and add the new key-value pair ('filter' => $key) --}}
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Section: Books --}}
    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">{{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                {{ number_format($book->reviews_avg_rating, 1) }}
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection
