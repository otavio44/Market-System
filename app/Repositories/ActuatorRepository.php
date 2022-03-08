<?php

namespace App\Repositories;

use App\Actuator;
use App\Repositories\Repository;

class ActuatorRepository extends Repository {

    public function add($actuator) {
        parent::save($actuator);
        return Actuator::where('id', Actuator::max('id'))->with('project')->get()->first();
    }

    public function read($id) {
        return Actuator::where('id', $id)->with('project')->get()->first();
    }

    public function update($actuator) {
        $actuator->save();
        return Actuator::where('id', $actuator->id)->with('project')->get()->first();
    }

    public function delete($id) {
        return Actuator::destroy($id);
    }
}
