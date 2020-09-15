<?php

use Illuminate\Database\Seeder;
use App\UsersTableSeeder;
use App\MessagesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
    }
}
