<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data   = [
            'name' => 'Admin'
        ];

        $admin = Role::create($data);

        $data   = [
            'name' => 'Customer'
        ];

        $customer = Role::create($data);

        $data   = [
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
        ];

        $user = User::create($data);

        $user->syncRoles($admin);

        $data   = [
            'name' => 'Customer',
            'email' => 'customer@mail.com',
            'password' => Hash::make('12345678'),
        ];

        $user = User::create($data);

        $user->syncRoles($customer);

        Artisan::call('passport:install');
    }
}
