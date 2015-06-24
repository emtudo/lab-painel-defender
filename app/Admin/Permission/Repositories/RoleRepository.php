<?php

namespace ResultSystems\Emtudo\Admin\Permission\Repositories;

use Artesaos\Defender;
use ResultSystems\Emtudo\Admin\Permission\Models\RoleUser;
use Defender;

class RoleRepository implements iRoleRepository {
	public function index()
	{
		return Permission::orderby('readable_name')->get();
	}
    public function hasRole($user,$role)
    {
    	if (!is_array($role))
    		$role=array($role);
    	$roles=Role::whereIn('id',explode(',',$role))->get();
    	if (count($roles)!=cont($role))
    		return response('Grupos de Permissões inválidos',422);
    	foreach ($permission as $value) {
    		
    	}
    }
}
