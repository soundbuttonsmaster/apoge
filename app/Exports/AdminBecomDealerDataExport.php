<?php

namespace App\Exports;

use App\Models\BecomeADealer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class AdminBecomDealerDataExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BecomeADealer::select('id', 'name', 'email', 'phone', 'state', 'district', 'village', 'intersted_in', 'created_at')->latest()->get();
    }

    public function headings(): array
    {
        return ["S. No", 'Date', "Name", "Email", "Mobile", "State", "District", "Village", "Interested"];
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
            $data->village,
            $data->intersted_in,
        ];
    }
}
