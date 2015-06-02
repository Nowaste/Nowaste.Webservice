<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 16:58
 */

namespace App\Http\Transformers;


use App\Models\Food;
use App\Models\Fridge;
use League\Fractal\TransformerAbstract;

class FoodTransformer extends TransformerAbstract
{

    public function transform(Food $food)
    {
        $return = [
            'id'    => (int) $food->id,
            'name'  => $food->name
        ];

        if($foodFridge = $food->foodFridge)
        {
            $return['out_of_date'] = $foodFridge->out_of_date;
            $return['quantity'] = $foodFridge->quantity;
            $return['visible'] = $foodFridge->visible;
            $return['open'] = $foodFridge->open;
        }

        return $return;
    }
}