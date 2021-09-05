<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new \App\Models\Mahasiswa();
        $item->name = "Iis Aidah ekasari";
        $item->nim = "20180140101";
        $item->no_wa = "0891234562";
        $item->angkatan = "2018";
        $item->id_tele = "@iis";
        $item->user_id = 5;

        $item->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
