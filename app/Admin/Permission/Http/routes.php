<?php
//Permissões
Route::get('resetall', [
	'middleware' => 'RoleOrPermission',
	// 'is' => 'admin',
	'can' => 'permission.resetall',
	'any'=>true,
	'as' => 'resetall',
	'uses' => 'PermissionController@getResetall',
]);
Route::post('resetall', [
	'middleware' => 'RoleOrPermission',
	// 'is' => 'admin',
	'can' => 'permission.resetall',
	'any'=>true,
	'as' => 'resetall',
	'uses' => 'PermissionController@postResetall',
]);
Route::get('user/{user}', [
	'middleware' => 'RoleOrPermission',
	// 'is' => 'admin',
	'can' => ['permission.show.user','permission.resetall'],
	'any'=>true,
	'as' => 'show.user',
	'uses' => 'PermissionController@showUser',
]);
Route::put('user/{id}', [
	'middleware' => 'RoleOrPermission',
	// 'is' => 'admin',
	'can' => 'permission.resetall',
	'any'=>true,
	'as' => 'user.update',
	'uses' => 'PermissionController@userUpdate',
]);
//Groups
Route::group(['prefix' => 'group','as' => 'group.'],function(){
	Route::get('{id}/permissions', [
		'middleware' => 'RoleOrPermission',
		// 'is' => 'admin',
		'can' => ['permission.group.crate','permission.group.update'],
		'any'=>true,
		'as' => 'show.permissions',
		'uses' => 'GroupController@getPermissions',
	]);
	Route::get('create', [
		'middleware' => 'RoleOrPermission',
		// 'is' => 'admin',
		'can' => 'permission.group.create',
		'any'=>true,
		'as' => 'create',
		'uses' => 'GroupController@create',
	]);
	Route::post('/', [
		'middleware' => 'RoleOrPermission',
		// 'is' => 'admin',
		'can' => 'permission.group.create',
		'any'=>true,
		'as' => 'save',
		'uses' => 'GroupController@store',
	]);
	Route::put('/{id}', [
		'middleware' => 'RoleOrPermission',
		// 'is' => 'admin',
		'can' => 'permission.group.update',
		'any'=>true,
		'as' => 'update',
		'uses' => 'GroupController@update',
	]);
	Route::delete('/{id}', [
		'middleware' => 'RoleOrPermission',
		// 'is' => 'admin',
		'can' => 'permission.group.delete',
		'any'=>true,
		'as' => 'delete',
		'uses' => 'GroupController@destroy',
	]);
});
