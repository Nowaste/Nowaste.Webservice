<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuration
 * @package App\Models
 */
class Configuration extends Model
{

    /**
     * @var string
     */
    protected $table = 'configurations';

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
}
