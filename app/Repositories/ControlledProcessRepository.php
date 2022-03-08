<?php

namespace App\Repositories;

use App\ControlledProcess;
use App\Repositories\Repository;

class ControlledProcessRepository extends Repository {

    public function add($controlledProcess) {
        parent::save($controlledProces);
        return ControlledProcess::where('id', ControlledProcess::max('id'))->with('project')->get()->first();
    }

    public function read($id) {
        return ControlledProcess::where('id', $id)->with('project')->get()->first();
    }

    public function update($controlledProcess) {
        $controlledProcess->save();
        return ControlledProcess::where('id', $controlledProcess->id)->with('project')->get()->first();
    }

    public function delete($id) {
        return ControlledProcess::destroy($id);
    }

}
