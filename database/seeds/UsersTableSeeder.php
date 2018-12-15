<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_quanly = Role::where('name', 'quanly')->first();
        $role_kho  = Role::where('name', 'kho')->first();
        $role_shipper = Role::where('name', 'shipper')->first();
        $role_customer = Role::where('name', 'khachhang')->first();


        $quanly = new User();
        $quanly->name = 'Quang';
        $quanly->email = 'quanly01@gmail.com';
        $quanly->password = bcrypt('12345678');
        $quanly->save();
        $quanly->roles()->attach($role_quanly);

        $kho = new User();
        $kho->name = 'Huy';
        $kho->email = 'kho01@example.com';
        $kho->password = bcrypt('12345678');
        $kho->save();
        $kho->roles()->attach($role_kho);

        $shipper = new User();
        $shipper->name = 'Ngoc';
        $shipper->email = 'shipper01@gmail.com';
        $shipper->password = bcrypt('12345678');
        $shipper->save();
        $shipper->roles()->attach($role_shipper);

        $customer = new User();
        $customer->name = 'Chi';
        $customer->email = 'khachhang01@gmail.com';
        $customer->password = bcrypt('12345678');
        $customer->save();
        $customer->roles()->attach($role_customer);
    }
}
