<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Repository;

class UserRepository extends Repository {

    public function getIdByEmail($emailUser) {
        return User::where('email', $emailUser)->get()->first()->id;
    }


    public function getProjectsByIdUser($idUser){
    	return User::where('id', $idUser)->with('projects')->get()->first()->projects;
    }

    public function add($model){
        
    }

    public function read($model){
        
    }

    public function update($model){
        
    }

    public function delete($model){
        
    }

}
