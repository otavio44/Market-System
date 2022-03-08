<?php

namespace App\Repositories;

use App\State;
use App\Repositories\Repository;

class StateRepository extends Repository
{

    public function add($state)
    {
        parent::save($state);
        return State::where('id', State::max('id'))->with('variable')->get()->first();
    }

    public function delete($id)
    {
        return State::destroy($id);
    }
}
