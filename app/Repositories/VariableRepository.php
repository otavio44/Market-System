<?php

namespace App\Repositories;

use App\Project;
use App\Repositories\Repository;

class VariableRepository extends Repository {

    public function add($project) {
        parent::save($project);
        return Project::where('id', Project::max('id'))->with('users')->get()->first();
    }

    public function read($id) {
        return Project::where('id', $id)->with('users')->get()->first();
    }

    public function update($project) {
        $project->save();
        return Project::where('id', $project->id)->with('users')->get()->first();
    }

    public function delete($id) {
        return Project::destroy($id);
    }

    public function addUsersOnProject($projectId, $idusers) {
        Project::where('id', $projectId)->get()->first()->users()->sync($idusers);
        return Project::where('id', $projectId)->with('users')->get()->first();
    }

}
