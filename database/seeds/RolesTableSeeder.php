<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$date=\Carbon\Carbon::now()->toDateTimeString();
        ResultSystems\Emtudo\Admin\Permission\Models\Role::insert([
                ['name'=>'** Acesso total ao sistema','created_at'=>$date,'updated_at'=>$date],
                ['name'=>'** Financeiro','created_at'=>$date,'updated_at'=>$date],
                ['name'=>'** Vendedor','created_at'=>$date,'updated_at'=>$date]
            ]
        );
        ResultSystems\Emtudo\Admin\Permission\Models\RoleUser::insert([
                [
                'role_id'=>1,
                'user_id'=>1
                ]
            ]
        );
    }
}
