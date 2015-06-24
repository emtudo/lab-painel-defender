<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    protected $toTruncate=['testes'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
            # code...
        }

        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
//user@resultsystems.com
//        $this->call('TestesTableSeeder');

        Model::reguard();
    }
}
