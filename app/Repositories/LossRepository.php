<?php

namespace App\Repositories;

use App\Loss;
use App\Repositories\Repository;

class LossRepository extends Repository
{

    public function add($loss)
    {
        parent::save($loss);
        return Loss::where('id', Loss::max('id'))
            ->with('hazards', 'project')->get()->first(); //retorna o Loss criado
    }
    
    public function read($id)
    {
        return Loss::where('id', $id)->with('hazards', 'project')->get()->first();
    }

    public function update($loss)
    {
        $loss->save();
        return Loss::where('id', $loss->id)->with('hazards', 'project')->get()->first();
    }

    public function delete($id)
    {
        return Loss::destroy($id);
    }
}
