<?php

namespace App\Imports;

use App\Models\District;
use App\Models\Division;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistrictImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Normalize values
        $districtName = trim(strtolower($row['district']));
        $divisionName = trim(strtolower($row['division']));

        // Create division if not exists
        $division = Division::firstOrCreate(
            ['name' => $divisionName],
            ['status' => true]
        );

        return District::updateOrCreate(
            [
                'name' => $districtName,
            ],
            [
                'division_id' => $division->id,
                'status'      => true,
            ]
        );
    }
}
