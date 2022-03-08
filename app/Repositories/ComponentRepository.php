<?php

namespace App\Repositories;

use App\Component;
use App\Repositories\Repository;

class ComponentRepository extends Repository
{

    public function add($component)
    {
        parent::save($component);
        return Component::where('id', Component::max('id'))->with('project')->get()->first();
    }

    public function delete($id)
    {
        return Component::destroy($id);
    }

    public function update($component)
    {
    }

    public function read($id)
    {
    }
}
