<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MemberExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function headings(): array{
        return [
            'Prenom',
            'Nom',
            'email',
        ];
    }

    public function collection()
    {
        return $this->data->map(function ($member) {
            return [
                'Prenom' => $member->firstName,
                'Nom' => $member->lastName,
                'email' => $member->email,
            ];
        });
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }



}
