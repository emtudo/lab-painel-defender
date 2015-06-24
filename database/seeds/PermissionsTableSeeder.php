<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$date=\Carbon\Carbon::now()->toDateTimeString();
      ResultSystems\Emtudo\Admin\Permission\Models\Permission::insert([
              ['id' => '1','name' => 'permission.resetall','readable_name' => '[permissões] Redefinir permissões de usuários','created_at'=>$date,'updated_at'=>$date],
              ['id' => '2','name' => 'permission.show.user','readable_name' => '[permissões] Ver permissões de usuário','created_at'=>$date,'updated_at'=>$date],
              ['id' => '15','name' => 'permission.group.create','readable_name' => '[permissões][grupo] Criar grupos','created_at'=>$date,'updated_at'=>$date],
              ['id' => '16','name' => 'permission.group.update','readable_name' => '[permissões][grupo] Atualizar grupos','created_at'=>$date,'updated_at'=>$date],
              ['id' => '17','name' => 'permission.group.delete','readable_name' => '[permissões][grupo] Apagar grupos','created_at'=>$date,'updated_at'=>$date]
        ]
    );
      ResultSystems\Emtudo\Admin\Permission\Models\PermissionRole::insert([
              ['permission_id' => '1',
                  'role_id' => '1'],
              ['permission_id' => '2',
                  'role_id' => '1'],
              ['permission_id' => '15',
                  'role_id' => '1'],
              ['permission_id' => '16',
                  'role_id' => '1'],
              ['permission_id' => '17',
                  'role_id' => '1'],
        ]
      );
    }
}
