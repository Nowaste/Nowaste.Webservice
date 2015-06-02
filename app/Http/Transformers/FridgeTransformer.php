<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 22:07
 */

namespace App\Http\Transformers;


use App\Models\Fridge;
use League\Fractal\TransformerAbstract;

class FridgeTransformer extends TransformerAbstract
{

    public function transform(Fridge $fridge)
    {
        $return = [
            'id'    => (int) $fridge->id,
            'name'  => $fridge->name
        ];

        return $return;
    }
}