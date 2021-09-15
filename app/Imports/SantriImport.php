<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;

class SantriImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $password = ('$2y$12$yEeLQTZtnfT77kjbTSFHJuSCD4g3Q6J1T9ourXCb.T8wpDZerCGW.');
        if (collect($row)->filter()->isNotEmpty()) {
            return new Santri([
                'nis' => $row[1],
                'nama' => $row[2],
                'kelas' => $row[3],
                'asrama' => $row[4],
                'jk' => $row[5],
                'no_telp' => "-",
                'line_id' => "-",
                'password' => $password,
                'jenjang' => $row[8],
                'password' => $password,
            ]);
        } else {
            return null;
        }

    }
}
