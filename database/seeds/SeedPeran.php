<?php

use Illuminate\Database\Seeder;
use App\Peran;
class SeedPeran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peran::truncate();
        Peran::create([
            "nama"=>"admin"
        ]);
        Peran::create([
            "nama"=>"user"
        ]);
    }
}
