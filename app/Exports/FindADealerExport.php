<?php

namespace App\Exports;

use App\Models\FindADealer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class FindADealerExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FindADealer::select('id', 'name', 'email', 'phone', 'state', 'district')->latest()->get();
    }


    public function headings(): array
    {
        return ["S. No", 'Date', "Name", "Email", "Mobile", "State", "District"];
    }

    public function map($data): array
    {
        static $serialNumber = 0;
        $serialNumber++; 

        return [
            $serialNumber,
            Carbon::parse($data->created_at)->format('d F Y'),
            $data->name,
            $data->email,
            $data->phone,
            $data->state,
            $data->district,
        ];
    }
}
