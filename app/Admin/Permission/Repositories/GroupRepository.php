<?php

namespace ResultSystems\Emtudo\Admin\Permission\Repositories;

use ResultSystems\Emtudo\Admin\Permission\Repositories\iPermissionRepository;
use ResultSystems\Emtudo\Admin\Permission\Models\Permission;
use ResultSystems\Emtudo\Admin\Permission\Models\Role;
use Defender;

class GroupRepository implements iGroupRepository {
	private $permRepo;
	public function __construct(iPermissionRepository $perm)
	{
		$this->permRepo=$perm;
	}
	public function setTotalByPage($total) {
	}
	public function getTotalByPage() {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Role::orderby('name')->get();
	}
	public function store($request)
	{
		try
		{
			if (!$this->permRepo->userHasPermission($request->permissionIds))
				return response('Permissões inválidas',422);
			$group = Defender::createRole($request->group['name']);
			// ou posso adicionar o usuário a um grupo e esse grupo tem a regra de poder criar usuários
			$group->attachPermission($request->permissionIds);
			$message=array('message'=>'Grupo: '.$group->name.' salvo com sucesso.','group'=>$group);
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao salvar o grupo, nome inválido ou existente.',422);
	}
	public function update($id, $request)
	{
		try
		{
			if (!$this->permRepo->userHasPermission($request->permissionIds))
				return response('Permissões inválidas',422);
			$group = Defender::findRoleById($id);
			$group->name=$request->group['name'];
			$group->save();
			$group->syncPermissions($request->permissionIds);

			$message=array('message'=>'Grupo: '.$group->name.' atualizado com sucesso.','group'=>$group);
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao salvar o grupo, nome inválido ou existente.',422);
	}
    public function destroy($id)
    {
		try
		{
			$group = Defender::findRoleById($id);
			$group->delete();
			$message=array('message'=>'Grupo: '.$group->name.' apagado com sucesso.','group'=>$group);
			return response($message,200);
		} catch (\Exception $e) {
		}
		return response('Falha ao apagar o grupo',422);
    }
}
