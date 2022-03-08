<?php

namespace App\Repositories;

use App\Sensor;
use App\Repositories\Repository;

class SensorRepository extends Repository
{

    public function add($sensor)
    {
        parent::save($sensor);
        return Sensor::where('id', Sensor::max('id'))->with('project')->get()->first();
    }

    public function read($id)
    {
        return Sensor::where('id', $id)->with('project')->get()->first();
    }

    public function update($sensor)
    {
        $sensor->save();
        return Sensor::where('id', $sensor->id)->with('project')->get()->first();
    }

    public function delete($id)
    {
        return Sensor::destroy($id);
    }
}
