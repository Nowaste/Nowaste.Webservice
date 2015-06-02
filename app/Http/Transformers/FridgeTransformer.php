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

/**
 * Class FridgeTransformer
 * @package App\Http\Transformers
 */
class FridgeTransformer extends TransformerAbstract
{

    /**
     * @param Fridge $fridge
     * @return array
     */
    public function transform(Fridge $fridge)
    {
        $return = [
            'id'    => (int) $fridge->id,
            'name'  => $fridge->name,
            'foods' => []
        ];

        $foodTransformer = new FoodTransformer();
        $fridge->foods->each(function($food) use($foodTransformer,&$return){
            $return['foods'][] = $foodTransformer->transform($food);
        });

        return $return;
    }
}