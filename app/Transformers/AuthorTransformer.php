<?php

namespace App\Transformers;

use App\Author;
use League\Fractal;

class AuthorTransformer extends Fractal\TransformerAbstract
{

    public function transform(Author $author) : array
    {
        return [
            'name' => $author->name,
        ];
    }
}