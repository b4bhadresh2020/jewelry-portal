<?php

use Illuminate\Database\Seeder;
use Junges\ACL\Http\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert(config('backendPermission', true));
    }
}
