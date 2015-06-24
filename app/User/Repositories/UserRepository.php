<?php

namespace ResultSystems\Emtudo\User\Repositories;

use ResultSystems\Emtudo\User\Models\User;

class UserRepository implements iUserRepository {
	private $user;
	public function __construct(User $user)
	{
		$this->user=$user;
	}
	public function setTotalByPage($total)
	{
	}
	public function getTotalByPage()
	{
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=$this->user->get();
		return $user;
	}
	public function store($request)
	{
	}
	public function update($id, $request)
	{
	}
    public function destroy($id)
    {
    }
}
