<?php

namespace App;

use App\Events\DescriptionCreated;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BookDescription extends Model
{
    protected $fillable = [
        'uuid',
        'book_id',
        'description',
        'language',
    ];

    public static function createWithAttributes(array $attributes): BookDescription
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new DescriptionCreated($attributes));

        return static::uuid($attributes['uuid']);
    }

    public static function uuid(string $uuid): ?BookDescription
    {
        return static::where('uuid', $uuid)->first();
    }
}
