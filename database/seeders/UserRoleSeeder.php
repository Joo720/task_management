<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
            // Retrieve all users except the admin
            $users = User::where('email', '!=', 'admin@example.com')->get();
            
            // Assign the role 'user' to each user
            foreach ($users as $user) {
                $user->assignRole('user');
            }
       
    }
}
