<?php

namespace App\Repositories;

use App\Hazard;
use App\Repositories\Repository;

class HazardRepository extends Repository {

    public function add($hazard){
        $idLosses = $hazard->lossesAssociated; //salvo os ids dos losses com hazards
        unset($hazard->lossesAssociated);//retiro a variavel dos Id de losses do Objeto Hazard
        parent::save($hazard);
        $hazard->losses()->sync($idLosses);
        return Hazard::where('id', Hazard::max('id'))->with('losses', 'project')->get()->first();//retorna o Hazard criado        
    }
    
    public function read($id){
        return Hazard::where('id', $id)->with('losses', 'project')->get()->first();       
    }

    public function update($hazard){
        $hazard->save();
        return Hazard::where('id', $hazard->id)->with('losses', 'project')->get()->first();
    }

    public function delete($id){
        return Hazard::destroy($id);
    }

    public function deleteAssociationWithLoss($idHazard, $idLoss){
        Hazard::find($idHazard)->losses()->detach($idLoss);
    }

}