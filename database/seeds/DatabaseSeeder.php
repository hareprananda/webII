<?php

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
        // $this->call(SeedPeran::class);
        // $this->call(SeederUser::class);
        // $this->call(SeederKelas::class);
        $this->call(JadwalSeeder::class);
    }
}
