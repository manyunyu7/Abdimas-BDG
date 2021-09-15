<?php

namespace Database\Seeders;

use App\Models\Keluarga;
use Exception;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $rt = $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        

        for ($i = 0; $i < 300; $i++) {
            try{
                $this->insert($faker->name, "citereup", $faker->numberBetween(100000000000, 999999999999), $faker->numerify('628##########'), $faker->address, 1);                
            }catch(Exception $exception){
                continue;
            }
        }
    }

    function insert($name, $password, $no_kk, $kontak, $alamat, $rt)
    {
        $data = new Keluarga();
        $data->nama = $name;
        $data->password = bcrypt($password);
        $data->no_kk = $no_kk;
        $data->no_kk = $no_kk;
        $data->kontak = $kontak;
        $data->alamat = $alamat;
        $data->photo_kartu_keluarga = null;
        $data->rt = $rt;
        $data->save();
    }
}
