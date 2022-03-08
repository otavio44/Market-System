<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loss extends Model
{
    public function hazards()
    {
        return $this->belongsToMany(Hazard::class, 'losses_hazards');
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
