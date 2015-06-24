<?php

namespace ResultSystems\Emtudo\Admin\Permission\Repositories;

use ResultSystems\Emtudo\Admin\Permission\Models\Permission;
use ResultSystems\Emtudo\Admin\Permission\Models\Role;
use ResultSystems\Emtudo\Admin\Permission\Models\PermissionUser;
use ResultSystems\Emtudo\Admin\Permission\Models\RoleUser;
use Illuminate\Contracts\Auth\Guard;
use Defender;

/*
esta classe tem objetivo de cadastrar permissões
*/
class PermissionRepository implements iPermissionRepository {

	private $user;
	private $auth;

	public function __construct(Guard $auth)
	{
		$this->auth=$auth;
		$this->user=$auth->user();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Permission::orderby('readable_name')->get();
	}
	public function getGroup()
	{
		return Role::orderby('name')->get();
	}
	public function store($request)
	{
		try
		{
			$permission = Permission::create(['name'=>$request->name,'readable_name'=>$request->readableName]);
			$message=array('message'=>'Permissão: '.$permission->name.' salva com sucesso.','permission'=>$permission,'_token'=>csrf_token());
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao salvar a permissão.',422);
	}
	public function update($id, $request)
	{
		try
		{
			$permission = Defender::findPermissionById($id);
			$permission->name=$request->name;
			$permission->readable=$request->readable;
			$permission->save();
			$message=array('message'=>'Permissão: '.$permission->readable.' atualizada com sucesso.','permission'=>$permission,'_token'=>csrf_token());
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao atualizar o grupo.',422);
	}
    public function destroy($id)
    {
		try
		{
			$permission = Defender::findPermissionById($id);
			$permission->delete();
			$message=array('message'=>'Permissão: '.$permission->name.' apagado com sucesso.','permission'=>$permission,'_token'=>csrf_token());
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao apagar a permissão.',422);
    }
    //salva alterações
	public function postResetall($request)
	{
		//$this->auth->user()->revokeExpiredPermissions();
		if ($request->has('userIds'))
			$userIds=$request->userIds;
		else
			return response('Você precisa informar os usuários',406);
		if (($key = array_search($this->user->id, $userIds)) !== false) {
		    unset($userIds[$key]);
		}
		if (count($userIds)<1)
			return response('Você não pode redefinir suas próprias permissões.',406);
		if ($request->has('permissionIds'))
			$permissionIds=$request->permissionIds;
		else
			$permissionIds=false;
		if ($request->has('sessionIds'))
			$sessionIds=$request->sessionIds;
		else
			$sessionIds=false;
		if ($request->has('reset')) {
			if ($request->reset=='yes')
				$reset=true;
			else
				$reset=false;
		} else
			$reset=false;
		if (!$reset && !$sessionIds && !$permissionIds)
			return response('Você não informou permissão alguma',406);

		if ($reset) {
			PermissionUser::whereIn('user_id',$userIds)->delete();
			RoleUser::whereIn('user_id',$userIds)->delete();
		}
		if ($permissionIds) {
			//Bloquea tentativa de usuário adicionar permissões
			//a outros usuários que ele mesmo não tem.
			if (!$this->userHasPermission($permissionIds))
				return response('Permissões inválidas',422);
			foreach ($userIds as $id) {
				foreach ($permissionIds as $permissionId) {
					try
					{
						$p=new PermissionUser;
						$p->user_id=$id;
						$p->permission_id=$permissionId;
						$p->save();
					} catch (\Exception $e) {
					}
				}
	    		//$key->attachPermission($permissions);
			}
		}
		if ($sessionIds) {
			//Bloqueia o usuário de dá permissão de grupos
			//a outros usuários que ele mesmo não tem.
			if (!$this->userHasRoles($sessionIds))
				return response('Permissões inválidas',422);
			foreach ($userIds as $id) {
				foreach ($sessionIds as $sessinoId) {
					try
					{
						$r=new RoleUser;
						$r->user_id=$id;
						$r->role_id=$sessinoId;
						$r->save();
					} catch (\Exception $e) {
					}
				}
	    		//$key->attachPermission($permissions);
			}
		}
		return response($request->userIds,200);
	}
/*
    private function permissionsExists($perms)
    {
    	if (!is_array($perms))
    		$perms=array($perms);
    	foreach ($perms as $perm) {
    		if (!Defender::findPermissionById($perm))
    			return false;
    	}
    	return true;
    }
    private function rolesExists($roles)
    {
    	if (!is_array($roles))
    		$roles=array($roles);
    	foreach ($roles as $role) {
    		if (!Defender::findRoleById($role))
    			return false;
    	}
    	return true;
    }
*/
/*
    public function revokePermissions()
    {
 		$this->auth->revokePermissions();
 		$this->revokeExpiredPermissions();
    }
    public function revokeExpiredPermissions()
    {
 		$this->auth->revokeExpiredPermissions();
    }
*/
    public function getPermissionsByUser($permIds=false)
    {
    	$user=$this->user;
		$p=Permission
    		::whereHas("users", function($query) use($user)
	    		{
	    			//id no sistema que estou usando é Id
	    			//So alterar aqui para o padrão id
	    			$query->where("id", $user->id);
	    		});
    	if ($permIds)
    		$p=$p->whereIn("id", $permIds);
    	return $p->orderby('readable_name')->get();
    }
    //Seleciona as (roles) que usuário tem acesso
    //sem está cadastrado, porém que tenha permissões
    //equivalentes em outro role ou permissão particular
    public function getRolesAccessByUser()
    {
    	$roles=Role::all();
    	$r=[];
    	foreach ($roles as $key => $role) {
    		$x=$this->userHasRoles($role->id);
    		if ($x)
    			$r[]=$role->id;
    	}
    	return Role::whereIn('id',$r)->get();
    }
    //Este metodo não deve ser usado fora do repositorio
    //muito provavelmente sua necessidade seja o método:
    //getRolesAccessByUser
    private function getPermissionRolesByUser($roleIds=false)
    {
    	$user=$this->user;
    	if ($roleIds && !is_array($roleIds))
    		$roleIds=array($roleIds);
		return Permission
			::whereHas("roles", function($query) use($roleIds, $user)
	    		{
	    			//id no sistema que estou usando é Id
	    			//So alterar aqui para o padrão id
	    			$query
	    				->whereHas("users", function($q) use($user)
			    		{
			    			//id no sistema que estou usando é Id
			    			//So alterar aqui para o padrão id
		    				$q->where("id", $user->id);
			    		});
			    		if ($roleIds)
			    			$query=$query->whereIn("role_id", $roleIds);
	    		})
			->orderby('name')
		   	->get();
    }
    //recebe todas as permissões do usuários
    //tanto de roles quanto de permissions
    public function getAllPermissionsByUser()
    {
    	$perm=$this->getPermissionsByUser();
    	$role=$this->getPermissionRolesByUser();
   		return $perm->merge($role);
    }
    //metodo público com objetivo de ser usado em outros lugares que
    //não seja este repositório
    public function userHasPermission($permIds)
    {
    	if (!is_array($permIds))
    		$permIds=array($permIds);
    	//Permissões baseadas no usuário
    	$permissions=$this->getAllPermissionsByUser($permIds);
    	foreach ($permIds as $id) {
    		$has=false;
	    	foreach ($permissions as $permission) {
	    		if ($id==$permission->id) {
	    			$has=true;
	    			break 1;
	    		}
	    	}
	    	if (!$has) {
	    		return false;
	    	}
    	}
    	return true;
    }
    //metodo público com objetivo de ser usado em outros lugares que
    //não seja este repositório
    public function userHasRoles($sessionIds)
    {
    	if (!is_array($sessionIds))
    		$sessionIds=array($sessionIds);
    	//Permissões baseadas no usuário
		//id no sistema que estou usando é Id
		//So alterar aqui para o padrão id
    	$permAccess=$this->getAllPermissionsByUser();
    	$sessions=Role::whereIn('id',$sessionIds)->with('permissions')->get();
    	foreach ($sessions as $session) {
    		foreach ($session->permissions as $permission) {
    			$has=false;
    			foreach ($permAccess as $p) {
    				if ($p->id==$permission->id) {
    					$has=true;
    					break;
    				}
    			}
		    	if (!$has) {
		    		return false;
		    	}
    		}
    	}
    	return true;
    }
    public function getPermissionsByGroup($id)
    {
		return Permission
    		::join('permission_role','permission_role.permission_id','=','permissions.id')
    		->where('permission_role.role_id',$id)
    		->get();

    }
}
