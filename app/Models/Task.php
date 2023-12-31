<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'startDate',
        'endDate',
        'project_id'
    ];

    // protected $hidden = [
    //     'project_id',
    // ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
