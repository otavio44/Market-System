<?php

namespace App\Repositories;

use App\SystemGoal;
use App\Repositories\Repository;

class SystemGoalRepository extends Repository {

    public function add($systemGoal) {
        parent::save($systemGoal);
        return SystemGoal::where('id', SystemGoal::max('id'))->with('project')->get()->first();
    }

    public function read($id) {
        return SystemGoal::where('id', $id)->with('project')->get()->first();
    }

    public function update($systemGoal) {
        $systemGoal->save();
        return SystemGoal::where('id', $systemGoal->id)->with('project')->get()->first();
    }

    public function delete($id) {
        return SystemGoal::destroy($id);
    }
}
