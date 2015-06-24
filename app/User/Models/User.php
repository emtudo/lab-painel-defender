<?php

namespace ResultSystems\Emtudo\User\Models;

use Artesaos\Defender\Traits\HasDefenderTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
	use Authenticatable, CanResetPassword, HasDefenderTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];
	public function permissions() {
	    	return $this->hasMany('ResultSystems\Emtudo\Admin\Permission\Models\PermissionUser','user_id','Id');
	}
	public function sessions() {
	    	return $this->hasMany('ResultSystems\Emtudo\Admin\Permission\Models\RoleUser','user_id','Id');
	}

}
