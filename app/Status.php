<?php

namespace App;

use App\Events\StatusCreated;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Status extends Model
{
    const OUT = 'OUT';
    const IN = 'IN';
    const DESTROYED = 'DESTROYED';

    protected $fillable = ['uuid', 'status', 'user_id', 'book_id'];

    public static function createWithAttributes(array $attributes): Status
    {
        $attributes['uuid'] = (string) Uuid::uuid4();

        event(new StatusCreated($attributes));

        return static::uuid($attributes['uuid']);
    }

    public static function uuid(string $uuid): ?Status
    {
        return static::where('uuid', $uuid)->first();
    }
}
