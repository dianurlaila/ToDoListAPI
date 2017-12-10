<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wahyu = new App\Models\User();
        $wahyu->name = "M Wahyu Firmansyah";
        $wahyu->username = "wahyu";
        $wahyu->email = "wahyu@gmail.com";
        $wahyu->password = Hash::make("123456");
        $wahyu->save();

        $dian = new App\Models\User();
        $dian->name = "Dian Nurlaila Sari";
        $dian->username = "dian";
        $dian->email = "dian@gmail.com";
        $dian->password = Hash::make("123456");
        $dian->save();

    }
}
