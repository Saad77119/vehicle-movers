<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(array('name' => 'dashboard'));
        Permission::create(array('name' => 'customers'));
        Permission::create(array('name' => 'drivers'));
        Permission::create(array('name' => 'vehicle'));
        Permission::create(array('name' => 'setup'));
        Permission::create(array('name' => 'roles and permissions'));
    }
}
