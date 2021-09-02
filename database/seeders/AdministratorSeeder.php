<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        // $administrator->name = "superadmin";
        // $administrator->email = "superadmin@gmail.com";
        // $administrator->roles = json_encode(["superadmin"]);
        // $administrator->password = \Hash::make("234234234");

        // $administrator->name = "admin";
        // $administrator->email = "admin@gmail.com";
        // $administrator->roles = json_encode(["admin"]);
        // $administrator->password = \Hash::make("kmtimaju");

        // $administrator->name = "test2";
        // $administrator->email = "test2@gmail.com";
        // $administrator->roles = json_encode("mahasiswa");
        // $administrator->password = \Hash::make("234234234");

        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}