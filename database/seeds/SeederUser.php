<?php

use Illuminate\Database\Seeder;
use App\User;
class SeederUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            "name"=>"Komang Nanda",
            "email"=>"hareprananda9@gmail.com",
            "peran_id"=>"2",
            "status"=>"unverified",
            "password"=>bcrypt("komangnanda")

        ]);
        User::create([
            "name"=>"Made Baerai",
            "email"=>"aderai9@gmail.com",
            "peran_id"=>"2",
            "status"=>"approve",
            "password"=>bcrypt("aderai")

        ]);
        User::create([
            "name"=>"Made Muku",
            "email"=>"demuk@gmail.com",
            "peran_id"=>"1",
            "status"=>"approve",
            "password"=>bcrypt("demuk")

        ]);
    }
}
