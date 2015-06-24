<?php

namespace ResultSystems\Emtudo\Admin\Permission\Repositories;

interface iPermissionRepository {
	public function index();
	public function getGroup();
	public function store($request);
	public function update($id, $request);
	public function destroy($id);
}
