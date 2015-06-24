<?php

namespace ResultSystems\Emtudo\Admin\Permission\Http\Controllers;

use Illuminate\Http\Request;
use ResultSystems\Emtudo\Core\Http\Requests;
use ResultSystems\Emtudo\Core\Http\Controllers\Controller;
use ResultSystems\Emtudo\User\Repositories\iUserRepository;
use ResultSystems\Emtudo\Admin\Permission\Repositories\iPermissionRepository;
use Illuminate\Contracts\Auth\Guard;

class PermissionController extends Controller {

	private $auth;
	private $userRepo;
	private $permRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(iUserRepository $user, iPermissionRepository $perm, Guard $auth)
	{
		$this->userRepo=$user;
		$this->permRepo=$perm;
		$this->auth=$auth;
	}
	//GET - Lista tudo
	public function getResetall()
	{
		return view('permission::resetall',[
			'user'=>$this->userRepo->index(),
			'permission'=>$this->permRepo->getAllPermissionsByUser(),
			'session'=>$this->permRepo->getRolesAccessByUser()]);
	}
	//GET - Formulário para criar
	public function create()
	{
		return 'create';
	}
	//POST - salva
	public function postResetall(Request $request)
	{
		return $this->permRepo->postResetall($request);
	}
	//GET - exibi
	public function showUser($user)
	{
		return view('permission::show.user',[
			'user'=>$user,
			'permission'=>$this->permRepo->getAllPermissionsByUser(),
			'session'=>$this->permRepo->getRolesAccessByUser()]);
	}
	//GET - exibi
	public function getUser($id)
	{
		return 'user';
	}
	//GET - exibi para editar
	public function edit($id)
	{
		return 'edit';
	}
	//PUT/PATCH - atualiza
	public function update(Request $request,$id)
	{
		return 'update';
	}
	//DELETE - store
	public function destory($id)
	{
		return 'destroy';
	}
}