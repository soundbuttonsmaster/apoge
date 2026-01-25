<?php

namespace App\Imports;

use App\Models\Dealer;
use Maatwebsite\Excel\Concerns\ToModel;

class DealersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dealer([
            'name'      => $row[0],
            'email'     => $row[1],
            'phone'     => $row[2],
            'state'     => $row[3],
            'district'  => $row[4],
            'location'  => $row[5],
            'status'    => $row[6] ?? 0,
        ]);
    }
}
