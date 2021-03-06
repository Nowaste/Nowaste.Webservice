<?php namespace App\Http\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user)
    {
        return [
            'id'     => (int) $user->id,
            'title' => $user->name,
        ];


    }
}