<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\PriceSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Carlos',
            'email' => 'carlos@carlos.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->call([
            CategorySeeder::class,
            LevelSeeder::class,
            PriceSeeder::class,
        ]);



    }
}
