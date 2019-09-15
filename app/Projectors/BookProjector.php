<?php

namespace App\Projectors;

use App\Author;
use App\Book;
use App\BookDescription;
use App\Events\AuthorAdded;
use App\Events\BookCreated;
use App\Events\BookWasCheckedIn;
use App\Events\BookWasCheckedOut;
use App\Events\DescriptionAdded;
use App\Status;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BookProjector implements Projector
{
    use ProjectsEvents;

    public function onBookCreated(BookCreated $event)
    {
        $book = Book::create($event->bookAttributes);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::IN,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }

    public function onDescriptionAdded(DescriptionAdded $event)
    {
        $book = Book::uuid($event->uuid);

        BookDescription::createWithAttributes([
            'book_id' => $book->id,
            'description' => $event->description,
            'language' => $event->language,
        ]);
    }

    public function onAuthorAdded(AuthorAdded $event)
    {
        $book = Book::uuid($event->uuid);

        Author::createWithAttributes([
            'book_id' => $book->id,
            'name' => $event->name,
        ]);
    }

    public function onBookWasCheckedOut(BookWasCheckedOut $event)
    {
        $book = Book::uuid($event->uuid);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::OUT,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }

    public function onBookWasCheckedIn(BookWasCheckedIn $event)
    {
        $book = Book::uuid($event->uuid);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::IN,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }
}
