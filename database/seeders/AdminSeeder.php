<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin table exists first
        if (!Schema::hasTable('admins')) {
            return;
        }

        // Check if admin already exists
        if (Admin::where('email', 'admin@gmail.com')->exists()) {
            return;
        }

        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('ABCStrong123'),
        ]);
    }
}
