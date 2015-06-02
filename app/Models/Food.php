<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Food
 * @package App\Models
 */
class Food extends Model
{
    /**
     * @var string
     */
    protected $table = 'foods';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fridge()
    {
        return $this->belongsTo('App\\Models\\Fridge');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customList()
    {
        return $this->belongsTo('App\\Models\\CustomList');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function infos()
    {
        return $this->hasOne('App\\Models\\FoodFridge');
    }


}
