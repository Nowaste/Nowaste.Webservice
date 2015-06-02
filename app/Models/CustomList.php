<?php namespace App\Models;

use App\Models\FoodList;
use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\\Models\\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany('App\\Models\\Food');
    }
}
