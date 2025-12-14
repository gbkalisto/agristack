<?php

namespace App\Imports;

use App\Models\Division;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DivisionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Debug (temporary)
        // dd($row);

        return Division::updateOrCreate(
            [
                'name' => trim($row['name']),
            ],
            [
                'status' => true,
            ]
        );
    }
}
