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
        $item->name = "Angga wika Nugraha";
        $item->nim = "20170140106";
        $item->no_wa = "0891234567";
        $item->angkatan = "2017";
        $item->id_tele = "@anggawika";
        $item->user_id = 2;


        $item->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
