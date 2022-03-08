<?php

namespace App\Repositories;

use App\SafetyConstraint;
use App\Repositories\Repository;

class SafetyConstraintRepository extends Repository
{

    public function add($safetyConstraint)
    {
        parent::save($safetyConstraint);
        return SafetyConstraint::where('id', SafetyConstraint::max('id'))
            ->with('controlaction', 'rule')->get()->first();
    }

    public function read($id)
    {
        return SafetyConstraint::where('id', $id)->with('controlaction', 'rule')->get()->first();
    }

    public function update($safetyConstraint)
    {
        $safetyConstraint->save();
        return SafetyConstraint::where('id', $safetyConstraint->id)->with('controlaction', 'rule')->get()->first();
    }

    public function delete($id)
    {
        return SafetyConstraint::destroy($id);
    }
}
