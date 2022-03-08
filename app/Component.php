<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model {

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
