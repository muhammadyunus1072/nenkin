<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("123"),
        ]);

        $user1 = User::create([
            'name' => "Sabrina",
            'email' => "sabrina@jexpertrecruitment.com",
            'password' => '$2y$12$GFT63uHthafzJejvn8f0me/SKVQbHnIZENPzkoE0iGrSdeVQwInNe',
            'phone' => "8118680136",
        ]);
        $user2 = User::create([
            'name' => "Tanjung",
            'email' => "tanjung@jexpertrecruitment.com",
            'password' => '$2y$12$sGNTAnNvArw0bUfXIrXLPOMj128JlS0e6L0RbLmppOLmATHuHHm8e',
            'phone' => "81220004752"
        ]);

        $user->assignRole('Admin');
        $user1->assignRole('Admin');
        $user2->assignRole('Admin');
    }
}
