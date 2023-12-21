<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class TaskImport implements ToModel, WithHeadingRow
{

    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            return new Task([
                'project_id' => $this->projectId,
                'name' => $row["nom"],
                'description' => $row["description"],
                'startDate' => isset($row["date_debut"]) ? Carbon::createFromFormat('Y-m-d', $row["date_debut"])->format('Y-m-d H:i:s') : null,
                'endDate' => isset($row["date_fin"]) ? Carbon::createFromFormat('Y-m-d', $row["date_fin"])->format('Y-m-d H:i:s') : null
            ]);
        }
        catch (\ErrorException $e) {
            return back()->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        }
    }

}
