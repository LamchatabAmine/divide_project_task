<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TaskExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function headings(): array{
        return [
            'Nom',
            'Description',
            'Date debut',
            'Date fin',
        ];
    }


    public function collection()
    {
        return $this->data->map(function ($task) {
            return [
                'Nom' => $task->name,
                'Description' => $task->description,
                'Date debut' => $task->startDate,
                'Date fin' => $task->endDate,
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
