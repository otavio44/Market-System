<?php

namespace App\Repositories;

use App\SystemSafetyConstraint;
use App\Repositories\Repository;

class SystemSafetyConstraintRepository extends Repository
{

    public function add($systemSafetyConstraint)
    {
        parent::save($systemSafetyConstraint);
        return SystemSafetyConstraint::where('id', SystemSafetyConstraint::max('id'))->with('project')->get()->first();
    }

    public function read($id)
    {
        return SystemSafetyConstraint::where('id', $id)->with('project')->get()->first();
    }

    public function update($systemSafetyConstraint)
    {
        parent::save($systemSafetyConstraint);
        return SystemSafetyConstraint::where('id', $id)->with('project')->get()->first();
    }

    public function delete($id)
    {
        return SystemSafetyConstraint::destroy($id);
    }

    public function addHazardsOnSystemSafetyConstraint($sys_safety_contraintId, $hazards_id)
    {
        SystemSafetyConstraint::where('id', $sys_safety_contraintId)->get()->first()->hazards()->sync($hazards_id);
        return SystemSafetyConstraint::where('id', $sys_safety_contraintId)->with('hazards')->get()->first();
    }

    public function deleteAssociationWithHazards($idSystemSafetyConstraint, $idHazard)
    {
        SystemSafetyConstraint::find($idSystemSafetyConstraint)->hazards()->detach($idHazard);
    }
}
