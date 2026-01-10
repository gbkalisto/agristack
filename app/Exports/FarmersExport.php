<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FarmersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::with([
            'district',
            'landDetail',
            'cropDetail',
            'bankDetail',
            'documents',
            'residentialDetail',
            'residentialDetail.division',
            'residentialDetail.district',
            'residentialDetail.block',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Father Name',
            'Mobile',
            'Email',
            'Aadhaar',
            'DOB',
            'Gender',
            'Category',
            'Address',

            'Residential Type',
            'Address English',
            'Address Local',
            'Division',
            'District',
            'Block',
            'Village',
            'Pincode',

            'Khata Number',
            'Plot Numbers',
            'Total Land',
            'Irrigation Source',
            'Ownership Type',

            'Main Crop',
            'Secondary Crop',
            'Season',

            'Bank Name',
            'Account Holder',
            'Account Number',
            'IFSC',

            'Aadhaar File',
            'Land Paper',
            'Bank Passbook',
            'Photo'
        ];
    }

    public function map($farmer): array
    {
        return [
            $farmer->name,
            $farmer->father_name,
            $farmer->phone,
            $farmer->email,
            $farmer->aadhaar,
            $farmer->dob,
            $farmer->gender,
            $farmer->category,
            $farmer->address,

            $farmer->residentialDetail->residential_type ?? '',
            $farmer->residentialDetail->address_english ?? '',
            $farmer->residentialDetail->address_local ?? '',
            $farmer->residentialDetail->division->name ?? '',
            $farmer->residentialDetail->district->name ?? '',
            $farmer->residentialDetail->block->name ?? '',
            $farmer->residentialDetail->village ?? '',
            $farmer->residentialDetail->pincode ?? '',

            $farmer->landDetail->khata_number ?? '',
            $farmer->landDetail->plot_numbers ?? '',
            $farmer->landDetail->total_land ?? '',
            $farmer->landDetail->irrigation_source ?? '',
            $farmer->landDetail->ownership_type ?? '',

            $farmer->cropDetail->main_crop ?? '',
            $farmer->cropDetail->secondary_crop ?? '',
            $farmer->cropDetail->season ?? '',

            $farmer->bankDetail->bank_name ?? '',
            $farmer->bankDetail->account_holder_name ?? '',
            $farmer->bankDetail->account_number ?? '',
            $farmer->bankDetail->ifsc_code ?? '',

            $farmer->documents->aadhaar_file ?? '',
            $farmer->documents->land_papers ?? '',
            $farmer->documents->bank_passbook ?? '',
            $farmer->documents->photo ?? '',
        ];
    }
}
