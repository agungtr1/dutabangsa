<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role admin
		$adminRole = new Role();
		$adminRole->name = "admin";
		$adminRole->display_name = "Admin";
		$adminRole->save();
		// Membuat role user
		$userRole = new Role();
		$userRole->name = "user";
		$userRole->display_name = "User";
		$userRole->save();
		// Membuat sample admin
		$admin = new User();
		$admin->name = 'Admin';
		$admin->email = 'admin@gmail.com';
		$admin->username = 'admin';
		$admin->password = bcrypt('rahasia');
		$admin->save();
		$admin->attachRole($adminRole);
		// Membuat sample member
		$member = new User();
		$member->name = "Sample User";
		$member->email = 'user@gmail.com';
		$member->username = 'user';
		$member->password = bcrypt('user');
		$member->save();
		$member->attachRole($userRole);
    }
}
