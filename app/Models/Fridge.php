<?php namespace App\Models;

use App\Models\FoodList;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fridge
 * @package App\Models
 */
class Fridge extends FoodList
{
    /**
     * @var string
     */
    protected $table = 'fridges';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany('App\\Models\\Food');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function watchers()
    {
        return $this->belongsToMany('App\\Models\\User', 'fridge_watchers');
    }

}
