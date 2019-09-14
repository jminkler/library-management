<?php

namespace App\Projectors;

use App\Book;
use App\BookDescription;
use App\Events\BookCreated;
use App\Events\DescriptionAdded;
use App\Events\DescriptionCreated;
use Spatie\EventProjector\Projectors\Projector;
use Spatie\EventProjector\Projectors\ProjectsEvents;

final class BookProjector implements Projector
{
    use ProjectsEvents;

    public function onBookCreated(BookCreated $event)
    {
        Book::create($event->bookAttributes);
    }

    public function onDescriptonCreated(DescriptionCreated $event)
    {
        BookDescription::create($event->attributes);
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
}
