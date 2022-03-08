<?php

namespace App\Repositories;

use App\ControlAction;
use App\Repositories\Repository;

class ControlActionRepository extends Repository
{

    public function add($controlAction)
    {
        parent::save($controlAction);
        return ControlAction::where('id', ControlAction::max('id'))->with('controller')->get()->first();
    }

    public function delete($id)
    {
        return ControlAction::destroy($id);
    }

    public function read($id)
    {
    }

    public function update($controlAction)
    {
    }
}
