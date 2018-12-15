<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $role_employee = new Role();
       $role_employee->name = 'quanly';
       $role_employee->description = 'quản lý ';
       $role_employee->save();

       $role_employee = new Role();
       $role_employee->name = 'kho';
       $role_employee->description = 'kho';
       $role_employee->save();

       $role_employee = new Role();
       $role_employee->name = 'shipper';
       $role_employee->description = 'nhân viên giao hàng';
       $role_employee->save();

       $role_customer = new Role();
       $role_customer->name = 'khachhang';
       $role_customer->description = 'khách hàng';
       $role_customer->save();
    }
}
