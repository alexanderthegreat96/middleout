<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Api\V1\Article;
use App\Models\Api\V1\User;
use Database\Factories\Api\V1\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(40)
            ->create();

        Article::factory()
            ->count(40)
            ->create();
    }
}
