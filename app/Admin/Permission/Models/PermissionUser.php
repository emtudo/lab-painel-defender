<?php

namespace ResultSystems\Emtudo\Admin\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model {
	protected $table="permission_user";
	public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(config('defender.permission_user_table'), config('defender.permission_key'), 'user_id'
        )->withPivot('value', 'expires');
    }
}
