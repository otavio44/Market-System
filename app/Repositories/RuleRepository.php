<?php

namespace App\Repositories;

use App\Rule;
use App\Repositories\Repository;

class RuleRepository extends Repository
{

    public function add($rule)
    {
        parent::save($rule);
        return Rule::where('id', Rule::max('id'))->with(['variable','state','controlaction'])->get()->first();
    }

    public function delete($id)
    {
        return State::destroy($id);
    }
}
