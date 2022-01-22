<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesSafetyConstraintsHazards extends Model
{
    protected $table = "rules_safetyconstraints_hazards";

    public function rule()
    {
        return $this->belongsTo('App\Rule');
    }

    public function safetyConstraint()
    {
        return $this->belongsTo('App\SafetyConstraints');
    }

    public function hazard()
    {
        return $this->belongsTo('App\Hazards');
    }
}
