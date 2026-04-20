<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            SettingsSeeder::class,
            PagesSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@logistax.id'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );

        $admin->assignRole('Super Admin');
    }
}
