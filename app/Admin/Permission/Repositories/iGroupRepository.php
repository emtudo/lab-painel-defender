<?php

namespace ResultSystems\Emtudo\Admin\Permission\Repositories;

interface iGroupRepository {
	public function setTotalByPage($total);
	public function getTotalByPage();
	public function index();
	public function store($request);
	public function update($id, $request);
	public function destroy($id);
}
