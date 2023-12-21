<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        try {
            $this->validate($row);
            return new Project([
                'name' => $row["nom"],
                'description' => $row["description"],
                'startDate' => isset($row["date_debut"]) ? Carbon::createFromFormat('Y-m-d', $row["date_debut"])->format('Y-m-d H:i:s') : null,
                'endDate' => isset($row["date_fin"]) ? Carbon::createFromFormat('Y-m-d', $row["date_fin"])->format('Y-m-d H:i:s') : null
            ]);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('project.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        // catch (\ErrorException $e) {
        //     return redirect()->route('project.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        // }
    }



    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row)
    //     {
    //         Project::create([
    //             'name'  => $row[0],
    //             'description'    => $row[1],
    //             'startDate' => $row[2],
    //             'endDate' => $row[2],
    //         ]);
    //     }
    // }

    /**
     * Validate the row data.
     *
     * @param array $row
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validate(array $row)
    {
        $validator = Validator::make($row, [
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date_debut' => 'nullable|date_format:Y-m-d',
            'date_fin' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            $errorMessage = 'Les données fournies ne sont pas valides. Veuillez vérifier les erreurs ci-dessous et réessayer.';

            // Store the error message in the session
            session()->flash('error', $errorMessage);

            // throw new \Illuminate\Validation\ValidationException($validator, response()->json(['message' => $errorMessage], 422));
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }



}


