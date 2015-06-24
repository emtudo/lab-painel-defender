<?php

namespace ResultSystems\Emtudo\Admin\Permission\Models;

use Artesaos\Defender\Role as DefenderRole;

class Role extends DefenderRole {

	public function permissionByRole()
	{
        return $this->hasMany(
            config('defender.permission_model'));
	}
}
