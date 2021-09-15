<?php

namespace Database\Seeders;

use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RT_RW_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $this->insertRW("RW 01", "Annelies Melema", "citereup", "082123738700", $faker->address);
        $this->insertRW("RW 02", "Pramoedya", "citereup", "082123738701", $faker->address);
        $this->insertRW("RW 03", "Toer", "citereup", "082123738702", $faker->address);

        for ($i = 1; $i < 6; $i++) {
            $this->insertRT("RT 0$i", $faker->name, "citereup", "08232373870$i", $faker->address, 1);
        }
        for ($i = 1; $i < 6; $i++) {
            $this->insertRT("RT 0$i", $faker->name, "citereup", "08242373870$i", $faker->address, 2);
        }
        for ($i = 1; $i < 6; $i++) {
            $this->insertRT("RT 0$i", $faker->name, "citereup", "08252373870$i", $faker->address, 3);
        }
    }

    function insertRW($kode, $nama, $password, $kontak, $alamat)
    {
        $object = new RukunWarga();
        $object->kode = $kode;
        $object->nama = $nama;
        $object->password = bcrypt($password);
        $object->kontak = $kontak;
        $object->alamat = $alamat;
        $object->save();
    }

    function insertRT($kode, $nama, $password, $kontak, $alamat, $id_rw)
    {
        $object = new RukunTetangga();
        $object->kode = $kode;
        $object->alamat = $alamat;
        $object->nama = $nama;
        $object->password = bcrypt($password);
        $object->kontak = $kontak;
        $object->id_rw = $id_rw;
        $object->save();
    }
}
