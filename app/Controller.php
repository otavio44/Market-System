<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controller extends Model {

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
