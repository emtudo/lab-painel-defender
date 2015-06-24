<?php

namespace ResultSystems\Emtudo\Admin\Permission\Http\Controllers;

use Illuminate\Http\Request;
use ResultSystems\Emtudo\Core\Http\Requests;
use ResultSystems\Emtudo\Core\Http\Controllers\Controller;
use ResultSystems\Emtudo\Admin\Permission\Repositories\iGroupRepository;
use ResultSystems\Emtudo\Admin\Permission\Repositories\iPermissionRepository;

class GroupController extends Controller
{
    private $groupRepo;
    private $permRepo;
    public function __construct(iGroupRepository $group, iPermissionRepository $perm)
    {
        $this->groupRepo=$group;
        $this->permRepo=$perm;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("permission::group",[
            'group'=>$this->permRepo->getRolesAccessByUser(),
            'permission'=>$this->permRepo->getAllPermissionsByUser()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->groupRepo->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        return $this->groupRepo->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->groupRepo->destroy($id);
    }
    public function getPermissions($id)
    {
        return $this->permRepo->getPermissionsByGroup($id);
    }

}
