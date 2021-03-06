<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        $this->call(UserSeeder::class);
        // Add links
        $this->call(LinkSeeder::class);
    }
}
