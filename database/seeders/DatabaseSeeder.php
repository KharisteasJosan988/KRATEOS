<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@mail.com',
        // ]);

        DB::table('admins')->insert(
            [
                ['name' => 'Admin', 'email' => 'admin@mail.com', 'password' => bcrypt('admin@mail.com'), 'role' => 'admin'],
            ]
        );


        // DB::table('users')->insert(
        //     [
        //         'name' => 'User 1', 'email' => 'user1@mail.com', 'password' => bcrypt('user1@mail.com')
        //     ]
        // );
    }
}
