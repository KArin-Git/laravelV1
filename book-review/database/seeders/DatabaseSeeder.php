<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create 33 books and for each book create random number of reviews
        Book::factory(33)->create()->each(function ($book) {
            // how many reviews we want from particular book
            $numReviews = random_int(5, 39);
            // generate reviews for each book
            Review::factory()->count($numReviews)
                ->good()
                // book_id will be set automatically
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 39);
            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(34)->create()->each(function ($book) {
            $numReviews = random_int(5, 39);
            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
