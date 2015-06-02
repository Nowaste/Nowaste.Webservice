<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 23:00
 */

namespace App\Http\Transformers;


use App\Models\CustomList;
use League\Fractal\TransformerAbstract;

class CustomListTranformer extends TransformerAbstract
{

    public function transform(CustomList $customList)
    {
        $return = [
            'id'    => (int) $customList->id,
            'name'  => $customList->name,
            'foods' => []
        ];

        $foodTransformer = new FoodTransformer();
        $customList->foods->each(function($food) use($foodTransformer,&$return){
            $return['foods'][] = $foodTransformer->transform($food);
        });

        return $return;
    }
}