<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'review', 'rating'];

    public function book()
    {
        return $this->belongsTo(Book::class);
        // default column setup from Laravel >> class_id
        // return $this->belongsTO(Book::class, 'book_id', 'id');
    }

    protected static function booted() {
        // if the review is updated, then clear the cache of the book
        // whenever this review's model is modified, then this function will be called
        // **this happen to the model. It CANT be done directly inside db
        static::updated(fn (Review $review) => cache()->forget('book:' . $review->book_id));
        static::deleted(fn (Review $review) => cache()->forget('book:' . $review->book_id));
        
        // MARKME: this handler is not be called in every situation.
        // if we use mass assignment which means we update multiple rows at once, then this handler will not be called >> $review->book_id
    }
}
