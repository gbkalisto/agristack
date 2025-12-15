<?php

namespace App\Imports;

use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BlockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Normalize values (trim only, DO NOT lowercase)
        $divisionName = trim(strtolower($row['division'] ?? ''));
        $districtName = trim(strtolower($row['district'] ?? ''));
        $blockName    = trim(strtolower($row['block'] ?? ''));

        // Skip invalid rows
        if (! $divisionName || ! $districtName || ! $blockName) {
            return null;
        }

        /**
         * 1️⃣ Create / Get Division
         */
        $division = Division::firstOrCreate(
            ['name' => $divisionName],
            ['status' => true]
        );

        /**
         * 2️⃣ Create / Get District under Division
         */
        $district = District::firstOrCreate(
            [
                'name'        => $districtName,
                'division_id' => $division->id,
            ],
            ['status' => true]
        );

        /**
         * 3️⃣ Create / Update Block under District
         * Block name must be unique PER district
         */
        return Block::updateOrCreate(
            [
                'name'        => $blockName,
                'district_id' => $district->id,
            ],
            ['status' => true]
        );
    }
}
