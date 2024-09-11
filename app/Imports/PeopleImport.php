<?php
namespace App\Imports;

use App\Models\People;
use Maatwebsite\Excel\Concerns\ToModel;

class PeopleImport implements ToModel
{
    public function model(array $row)
    {
        return new People([
            'first_name' => $row[0],
            'last_name'  => $row[1],
            'email'      => $row[2],
            'gender'     => $row[3],
            'ip_address' => $row[4],
        ]);
    }
}
