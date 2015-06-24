<?php
Route::group(['middleware' => 'auth'], function() {
	//Nível de administrador
	Route::group(['prefix' => 'admin/permission',
			'as' => 'admin.permission.',
			'namespace' => 'Permission\Http\Controllers'],function(){
		require app_path('Admin/Permission/Http/routes.php');
	});
});
