<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hazard extends Model
{
    public function losses()
    {
        return $this->belongsToMany(Loss::class, 'losses_hazards');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
