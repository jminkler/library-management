<?php

namespace App\Reactors;

use App\Book;
use App\Events\StatusCreated;
use Spatie\EventProjector\EventHandlers\EventHandler;
use Spatie\EventProjector\EventHandlers\HandlesEvents;

final class UpdateStatus implements EventHandler
{
    use HandlesEvents;

    public function onStatusCreated(StatusCreated $event)
    {
        $book = Book::find($event->attributes['book_id']);
        $book->status = $event->attributes['status'];
        $book->save();
    }
}
