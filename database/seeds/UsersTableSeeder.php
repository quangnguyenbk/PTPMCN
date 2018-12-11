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
        App\User::create([
        	'name' => 'Badman',
        	'username' => 'quanly01',
        	'role' => '2',
        	'email' =>'quanly01@gmail.com',
        	'password' => bcrypt('12345678')
        ]);
    }
}
