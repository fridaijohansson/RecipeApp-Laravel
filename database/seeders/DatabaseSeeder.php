<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Super User',
            'username' => 'superuser',
            'email' => 'admin@example.com',
            'password' => 'superUser123',
            'is_admin' => 1,
        ]);

        User::factory()->create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => 'regularUser123',
            'is_admin' => 0,
        ]);

        Recipe::factory(20)->create();
    }
}
