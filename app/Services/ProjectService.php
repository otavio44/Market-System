<?php

namespace App\Services;

use App\Project;
use App\User;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;

class ProjectService extends Services {

    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository) {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    private $projectRepository;
    private $userRepository;

    public function add(Project $project) {
        $usersEmail = $project->users;
        unset($project->users);
        $projectSaved = $this->projectRepository->add($project);
        $project->URL = str_slug($project->name . " " . strval($projectSaved->id), '-');
        $this->projectRepository->update($project);
        return $this->addUsersOnProject($projectSaved->id, $usersEmail);
    }

    public function read($id) {
        $project = $this->projectRepository->read($id);
        if (is_null($project)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $project;
    }

    public function edit(Project $project) {
        return $this->projectRepository->update($project);
    }

    public function delete($id) {
        $projectDeleted = $this->projectRepository->delete($id);

        if ($projectDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function addUsersOnProject($projectId, $usersEmail) {
        $idusersEmail = [];
        foreach ($usersEmail as $emailUser) {
            array_push($idusersEmail, $this->userRepository->getIdByEmail($emailUser));
        }
        return $this->projectRepository->addUsersOnProject($projectId, $idusersEmail);
    }

    public function getUsers($id){
        $project = $this->projectRepository->read($id);
        $users = $project->users;
        $emailUsers = "";
        foreach ($users as $user) {
            $emailUsers  .= $user->email . ";";
        }
        return substr($emailUsers, 0, -1);
    }

}
