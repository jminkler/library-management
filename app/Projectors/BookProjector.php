<?php

namespace App\Projectors;

use App\Author;
use App\Book;
use App\BookDescription;
use App\Events;
use App\Events\AuthorUpdated;
use App\Status;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BookProjector implements Projector
{
    use ProjectsEvents;

    public function onBookCreated(Events\BookCreated $event)
    {
        $book = Book::create($event->bookAttributes);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::IN,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }

    public function onBookDeleted(Events\BookDeleted $event)
    {
        $book = Book::uuid($event->uuid);
        $book->delete();

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::DESTROYED,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }

    public function onBookUpdated(Events\BookUpdated $event)
    {
        $book = Book::uuid($event->uuid);
        $book->update($event->attributes);

    }

    public function onBookAuthorsUpdated(Events\BookAuthorsUpdated $event)
    {
        $book = Book::uuid($event->uuid);
        foreach ($event->attributes as $author) {
            event(new AuthorUpdated($author['uuid'], $author['name']));
        }
        $book->update($event->attributes);

    }

    public function onBookDescriptionsUpdated(Events\BookDescriptionsUpdated $event)
    {
        $book = Book::uuid($event->uuid);
        $book->update($event->attributes);

    }

    public function onDescriptionAdded(Events\DescriptionAdded $event)
    {
        $book = Book::uuid($event->uuid);

        BookDescription::createWithAttributes([
            'book_id' => $book->id,
            'description' => $event->description,
            'language' => $event->language,
        ]);
    }

    public function onAuthorAdded(Events\AuthorAdded $event)
    {
        $book = Book::uuid($event->uuid);

        Author::createWithAttributes([
            'book_id' => $book->id,
            'name' => $event->name,
        ]);
    }

    public function onBookWasCheckedOut(Events\BookWasCheckedOut $event)
    {
        $book = Book::uuid($event->uuid);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::OUT,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }

    public function onBookWasCheckedIn(Events\BookWasCheckedIn $event)
    {
        $book = Book::uuid($event->uuid);

        Status::createWithAttributes([
            'book_id' => $book->id,
            'status' => Status::IN,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
        ]);
    }
}
