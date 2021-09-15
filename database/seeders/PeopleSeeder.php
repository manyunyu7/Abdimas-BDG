<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *id	nama	username	email	nik	password	jk	no_telp	photo_path	remember_token	created_at	updated_at	
     * @return void
     */
    public function run()
    {
        // $this->insertUser("Razky Febriansyah","itsrazky","1202184200","razkyfeb@gmail.com","bandungJS","1","088223738700","");
        // $this->insertUser("Ahmad Syakir","ahmadsyakir","1202184201","ahmadsyakir@gmail.com","bandungJS","1","088223738701","");
        // $this->insertUser("Fauzy Kurnain","fauzykurnain","1202184202","fauzykurnain@gmail.com","bandungJS","1","088223738702","");
        // $this->insertUser("Tiara Khadijah","arayarayar","1202184203","ara@gmail.com","bandungJS","1","088223738703","");
        // $this->insertUser("Zafira Chaerunnisa","zafirachr","1202184204","zafirachr@gmail.com","bandungJS","2","088223738704","");
        // $this->insertUser("Ghina Khaerunnisa","ghinakhrn","1202184205","ghinakhrn@gmail.com","bandungJS","2","088223738705","");        

    }

    function insertUser($name,$username,$nik,$email,$password,$jk,$no_telp,$photo_path){
        $data = new People();
        $data->nama = $name;
        $data->username = $username;
        $data->nik = $nik;
        $data->email = $email;
        $data->password = bcrypt($password);
        $data->jk = $jk;
        $data->no_telp = $no_telp;
        $data->photo_path = $photo_path;
        $data->save();
    }
}
