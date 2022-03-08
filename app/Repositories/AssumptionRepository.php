<?php

namespace App\Repositories;

use App\Assumption;
use App\Repositories\Repository;

class AssumptionRepository extends Repository
{

    public function add($assumption)
    {
        parent::save($assumption);
        return Assumption::where('id', Assumption::max('id'))->with('project')->get()->first();
    }

    public function read($id)
    {
        return Assumption::where('id', $id)->with('project')->get()->first();
    }

    public function update($assumption)
    {
        $assumption->save();
        return Assumption::where('id', $assumption->id)->with('project')->get()->first();
    }

    public function delete($id)
    {
        return Assumption::destroy($id);
    }
}
