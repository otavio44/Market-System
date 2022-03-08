<?php

namespace App\Repositories;

use App\ContextTable;
use App\Repositories\Repository;

class ContextTableRepository extends Repository
{

    public function add($contextTable)
    {
        parent::save($contextTable);
        return ContextTable::where('id', ContextTable::max('id'))->get()->first();
    }

    public function delete($id)
    {
        return ContextTable::destroy($id);
    }

    public function read($id)
    {
        return ContextTable::where('id', $id)->get()->first();
    }
}
