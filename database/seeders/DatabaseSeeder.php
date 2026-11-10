<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Comment this when you commit
        // $this->seedAll();
    }

    private function seedAll(): void
    {
        $this->call([
            UsersTableSeeder::class
        ]);
    }
}
