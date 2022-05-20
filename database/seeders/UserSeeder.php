<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role = Role::create(['name' => 'admin']);
        $role_doctor = Role::create(['name' => 'employee']);
        $sin_rol = Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'iot_admin@gmail.com',
            'num_doc' => '75436405',
            'phone' => '943271725',
            'gender' => 1,
            'password' => bcrypt('123456789')
        ])->assignRole('admin');


        $user = User::create([
            'name' => 'Empleado',
            'email' => 'iot_employee@gmail.com',
            'num_doc' => '75436406',
            'phone' => '943271724',
            'gender' => 2,
            'password' => bcrypt('123456789')
        ])->assignRole('employee');
    }
}
