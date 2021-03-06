<?php

namespace App\Administracion;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
	
	protected $table = 'admin_users';
	
	use softDeletes;
		
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
		
	public function roles()
	{
		return $this->belongsToMany('App\Administracion\Role','admin_user_role');
	}
	
	public function hasRole($role)
	{
		if ($this->roles()->where('nombre', $role)->first()) {
			return true;
		}
		return false;
	}
}
