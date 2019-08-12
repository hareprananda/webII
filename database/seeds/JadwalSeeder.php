<?php

use Illuminate\Database\Seeder;
use App\Jadwal;
class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jadwal::truncate();
        $pemesann=[1,2,3,4,5,6,7,8,9,10];
        $kelass=[1,2,3,4,5,6,7,8,9,10];

        $pemesan=array_rand($pemesann);
        $kelas=array_rand($kelass);
        
        Jadwal::create([
            "pemesan"=>$pemesann[array_rand($pemesann)],
            "mulai"=>"12:00:00",
            "selesai"=>"13:00:00",
            "tanggal"=>date("Y-m-d"),
            "keperluan"=>'belajar',
            "id_kelas"=>$kelass[array_rand($kelass)],

        ]);

        Jadwal::create([
            "pemesan"=>'1',
            "mulai"=>"14:00:00",
            "selesai"=>"15:00:00",
            "tanggal"=>date("Y-m-d"),
            "keperluan"=>'nyusun rencana demo',
            "id_kelas"=>$kelass[array_rand($kelass)],

        ]);
        Jadwal::create([
            "pemesan"=>'1',
            "mulai"=>"10:00:00",
            "selesai"=>"11:00:00",
            "tanggal"=>date("Y-m-d"),
            "keperluan"=>'belajar politik',
            "id_kelas"=>$kelass[array_rand($kelass)],

        ]);
        Jadwal::create([
            "pemesan"=>'1',
            "mulai"=>"10:00:00",
            "selesai"=>"11:00:00",
            "tanggal"=>"2019-08-04",
            "keperluan"=>'sedeng dot gen',
            "id_kelas"=>$kelass[array_rand($kelass)],

        ]);
       
    }
}
