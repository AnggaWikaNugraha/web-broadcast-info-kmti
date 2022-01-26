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

        // $administrator->email = "superadmin@kmti.com";
        // $administrator->roles = "superadmin"
        // $administrator->password = \Hash::make("234234234");

        $administrator->email = "admin@kmti.com";
        $administrator->roles = "admin";
        $administrator->password = \Hash::make("234234234");

        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
