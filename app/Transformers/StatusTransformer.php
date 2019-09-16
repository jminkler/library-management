<?php


namespace App\Transformers;

use App\Book;
use App\User;
use League\Fractal;

class StatusTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'book', 'user'
    ];

    public function transform($status): array
    {
        return [
            'status' => $status->status
        ];
    }

    public function includeBook($status)
    {
        $book = Book::withTrashed()->find($status->book_id);

        return $this->item($book, new BookTransformer);
    }

    public function includeUser($status)
    {
        $user = User::find($status->user_id);

        if ($user) {
            return $this->item($user, new UserTransformer);
        }
        return null;
    }
}
