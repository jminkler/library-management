<?php


namespace App\Transformers;

use App\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'username' => $user->username
        ];
    }
}
