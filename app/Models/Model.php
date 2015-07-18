<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 01/06/15
 * Time: 15:28
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Model
 * @package App\Models
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static function getTableName()
    {
        return with(new static)->table;
    }
} 