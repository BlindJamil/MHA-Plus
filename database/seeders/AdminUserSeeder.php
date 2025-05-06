<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'MHA Admin',
            'email' => 'admin@mhaplus.com',
            'password' => Hash::make('MhaPlus2025'),
        ]);

        $this->command->info('Admin user created successfully!');
    }
}