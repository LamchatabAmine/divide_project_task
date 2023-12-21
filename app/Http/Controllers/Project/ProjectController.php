<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\ProjectExport;
use App\Imports\ProjectImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\ProjectRepository;
// use App\Http\Requests\ProjectTaskRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Controllers\AppBaseController;


class ProjectController extends AppBaseController
{

    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }


    public function index()
    {
        $projects = $this->projectRepository->index();

        return view('project.index', compact('projects'));
    }


    public function create()
    {
        return view('project.create');
    }


    public function store(ProjectRequest $request)
    {
        $validatedData = $request->all();

        $this->projectRepository->store($validatedData);

        return redirect()->route('project.index')->with('success', 'projet créé avec succès');
    }




    public function edit(Project $project)
    {
        $project = $this->projectRepository->edit($project);

        return view('project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $validatedData = $request->all();

        $this->projectRepository->update($validatedData, $project);

        return redirect()->route('project.index')->with('success', 'projet mis à jour avec succès.');
    }


    public function destroy(Project $project)
    {

        $this->projectRepository->destroy($project);

        return redirect()->route('project.index')->with('success', 'projet supprimé avec succès');
    }


    public function export()
    {
        $projects = Project::all();

        return Excel::download(new ProjectExport($projects), 'projects.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new ProjectImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('project.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        // catch (\Error $e) {
        //     return redirect()->route('project.index')->withError('Quelque chose s\'est mal passé, vérifiez votre fichier');
        // }
        return redirect()->route('project.index')->with('success', 'Projet a ajouté avec succès');
    }



    public function search(Request $request)
    {
        $searchValue = $request->input('searchValue');
        // Check if the search value is empty
        if (empty($searchValue)) {
            $projects = $this->projectRepository->index();

        } else {
            $projects = $this->projectRepository->index(['search' => $searchValue]);
        }
        if ($request->ajax()) {
            return response()->json([
                'table' => view('project.table', compact('projects'))->render(),
                'pagination' => $projects->links()->toHtml(), // Get pagination links
            ]);
        }
    }




}
