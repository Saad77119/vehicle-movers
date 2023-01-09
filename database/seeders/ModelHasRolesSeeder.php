<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert(
            array('role_id' => '1','model_type' => 'App\Models\User', 'model_id' => '1')
        );
    }
}
