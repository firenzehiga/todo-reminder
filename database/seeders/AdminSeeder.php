<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat akun admin default
        $admins = [
            [
                'name' => 'Super Admin',
                
                'telepon' => '085894310722',
                'email' => 'admin@todoreminder.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin Manager',
                'telepon' => '085894310723',
                'email' => 'manager@todoreminder.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        $this->command->info('Admin accounts created successfully!');
        $this->command->info('Login credentials:');
        foreach ($admins as $admin) {
            $this->command->info("Email: {$admin['email']} | Password: admin123");
        }
    }
}