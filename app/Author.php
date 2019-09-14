<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\AuthorCreated;
use Ramsey\Uuid\Uuid;

class Author extends Model
{
    protected $fillable = ['name', 'uuid'];

    public static function createWithAttributes(array $attributes): Author
    {
        $attributes['uuid'] = (string) Uuid::uuid4();
        
        event(new AuthorCreated($attributes));

        $author = static::uuid($attributes['uuid']);
        
        if (isset($attributes['book_id'])) {
            $book = Book::find($attributes['book_id']);
            $book->authors()->save($author);
        }

        return $author;
    }

    public static function uuid(string $uuid): ?Author
    {
        return static::where('uuid', $uuid)->first();
    }

}
