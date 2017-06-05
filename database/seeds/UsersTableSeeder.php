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
    	$users = [
    		[
	        	'name' => 'Administrator',
	        	'email' => 'admin@mail.com',
	        	'password' => bcrypt('password'),
	        	'role' => 'admin'
	        ],[
	        	'name' => 'Manager',
	        	'email' => 'manager@mail.com',
	        	'password' => bcrypt('password'),
	        	'role' => 'manager'
	        ],[
	        	'name' => 'Supervisor',
	        	'email' => 'supervisor@mail.com',
	        	'password' => bcrypt('password'),
	        	'role' => 'supervisor'
	        ]
    	];
    	
        DB::table('users')->insert($users);
    }
}
