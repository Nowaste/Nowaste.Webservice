<?php namespace App\Models;

use App\Models\FoodList;

/**
 * Class CustomList
 * @package App\Models
 */
class CustomList extends FoodList
{

    /**
     * @var string
     */
    protected $table = 'custom_lists';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany('App\\Models\\Food');
    }
}
