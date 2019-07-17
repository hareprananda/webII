<?php

use Illuminate\Database\Seeder;
use App\Kelas;
class SeederKelas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::truncate();
        for($i=101;$i<=102;$i++){
            Kelas::create([
                "nama_kelas"=>$i,
                "jenis"=>"100"
            ]);
        }
        for($i=201;$i<=205;$i++){
            Kelas::create([
                "nama_kelas"=>$i,
                "jenis"=>"200"
            ]);
        }
        for($i=301;$i<=304;$i++){
            Kelas::create([
                "nama_kelas"=>$i,
                "jenis"=>"300"
            ]);
        }
        for($i=401;$i<=404;$i++){
            Kelas::create([
                "nama_kelas"=>$i,
                "jenis"=>"400"
            ]);
        }
        for($i=501;$i<=544;$i++){
            Kelas::create([
                "nama_kelas"=>$i,
                "jenis"=>"500"
            ]);
            if(((int)$i % 10)==4){
                $i=$i+6;
            }
        }
        Kelas::create([
            "nama_kelas"=>"Lab A",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Lab B",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Lab C",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Lab D",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Lab E",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Lab F",
            "jenis"=>"Aula & Lab"
        ]);
        Kelas::create([
            "nama_kelas"=>"Aula",
            "jenis"=>"Aula & Lab"
        ]);
    }
}
