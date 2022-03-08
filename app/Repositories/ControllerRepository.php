<?php

namespace App\Repositories;

use App\Controller;
use App\Repositories\Repository;

class ControllerRepository extends Repository
{

    public function add($controller)
    {
        parent::save($controller);
        return Controller::where('id', Controller::max('id'))->with('project')->get()->first();
    }

    public function read($id)
    {
        return Controller::where('id', $id)->with('project')->get()->first();
    }

    public function update($controller)
    {
        $controller->save();
        return Controller::where('id', $controller->id)->with('project')->get()->first();
    }

    public function delete($id)
    {
        return Controller::destroy($id);
    }
}
