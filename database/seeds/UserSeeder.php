<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = User::updateOrCreate(
            [
                'first_name' => "codexive",
                'last_name' => "solutions",
                'email' => DEV_EMAIL,
                'type' => 1
            ],
            [
                'password' => Hash::make('codexive@321'),
            ]
        );
        $developer->assignAllPermissions();

        $admin = User::updateOrCreate(
            [
                'first_name' => "Shivaay",
                'last_name' => "Jewels",
                'email' => 'admin@gmail.com',
                'type' => User::BACKEND_USER
            ],
            [
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->assignAllPermissions();

        factory(User::class)->times(2)->create();
    }
}
