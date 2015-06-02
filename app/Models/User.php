<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;


/**
 * Class User
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    public function foods()
    {
        return $this->hasMany('App\\Models\\Food');
    }

    public function configurations()
    {
        return $this->hasMany('App\\Models\\Configuration');
    }

    public function fridges()
    {
        return $this->hasMany('App\\Models\\Fridge');
    }

    public function watchingFridges()
    {
        return $this->belongsToMany('App\\Models\\Fridges', 'fridge_watchers');
    }

    public function customLists()
    {
        return $this->hasMany('App\\Models\\CustomList');
    }
}
