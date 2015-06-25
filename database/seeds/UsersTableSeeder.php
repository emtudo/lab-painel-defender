<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$date=\Carbon\Carbon::now()->toDateTimeString();
    	ResultSystems\Emtudo\User\Models\User::insert([
    			[
    			'name'=>'Administrador do Sistema',
    			'email'=>'admin@result.systems',
    			'password'=>bcrypt('admin'),
    			'created_at'=>$date,
    			'updated_at'=>$date],
    			[
    			'name'=>'Usuário restrito',
    			'email'=>'user@result.systems',
    			'password'=>bcrypt('user'),
    			'created_at'=>$date,
    			'updated_at'=>$date],
   			]
		);
    }
}
