<?php

namespace App\Transformers;

use App\BookDescription;
use League\Fractal;

class DescriptionTransformer extends Fractal\TransformerAbstract
{

    public function transform(BookDescription $bookDescription) : array
    {
        return [
            'description' => $bookDescription->description,
            'language' => $bookDescription->language,
        ];
    }
}