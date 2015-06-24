<?php

use Illuminate\Database\Seeder;

class TestesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory('ResultSystems\Testes',30)->create();
    }
}
