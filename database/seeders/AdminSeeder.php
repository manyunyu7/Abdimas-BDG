<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Admin();
        $data->name = "Henry Augusta Harsono";
        $data->contact = "088223738709";
        $data->photo_path = "";
        $data->email = "henryaugusta4@gmail.com";
        $data->password = bcrypt("citereup");
        $data->role = "admin";
        $data->save();

        $data = new Admin();
        $data->name = "Muhammad Firriezky";
        $data->contact = "088223738700";
        $data->photo_path = "";
        $data->email = "firriezky@gmail.com";
        $data->password = bcrypt("citereup");
        $data->role = "admin";
        $data->save();
    }
}
