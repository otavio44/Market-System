<?php

namespace App\Services;

use App\SystemSafetyConstraint;
use Illuminate\Routing\Redirector;
use App\Repositories\SystemSafetyConstraintRepository;

class SystemSafetyConstraintService extends Services {

    public function __construct(SystemSafetyConstraintRepository $systemSafetyConstraintRepository) {
        $this->systemSafetyConstraintRepository = $systemSafetyConstraintRepository;
    }

    private $systemSafetyConstraintRepository;

    public function add($sys_safety_contraint) {
        $hazards_id = $sys_safety_contraint->hazards;
        unset($sys_safety_contraint->hazards);
        $sys_safety_contraintSaved = $this->systemSafetyConstraintRepository->add($sys_safety_contraint);
        return $this->addHazardsOnSystemSafetyConstraint($sys_safety_contraintSaved->id, $hazards_id);
    }

    public function read($id) {
        $systemSafetyConstraint = $this->systemSafetyConstraintRepository->read($id);
        if (is_null($systemSafetyConstraint)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $systemSafetyConstraint;
    }

    public function edit($sys_safety_contraint) {
        return $this->systemSafetyConstraintRepository->update($sys_safety_contraint);
    }

    public function delete($id) {
        $systemSafetyConstraint = $this->systemSafetyConstraintRepository->delete($id);

        if ($systemSafetyConstraint) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function addHazardsOnSystemSafetyConstraint($sys_safety_contraintId, $hazards_id) {
        return $this->systemSafetyConstraintRepository->addHazardsOnSystemSafetyConstraint($sys_safety_contraintId, $hazards_id);
    }

     public function deleteAssociationWithHazards($idSystemSafetyConstraint, $idHazard){

        $this->systemSafetyConstraintRepository->deleteAssociationWithHazards($idSystemSafetyConstraint, $idHazard);

        $count = count($this->read($idSystemSafetyConstraint)->hazards);

        return response()->json([
            'count' => $count
        ]);
    }

    public static function mapConstraints($project_id){
        $syscons = SystemSafetyConstraint::where('project_id', $project_id)->get();
        $index = 0;

        $syscons_map = null;

        foreach($syscons as $sysconstraint) {
            $syscons_map[$sysconstraint->id] = ++$index;
        }
        return $syscons_map;
    }

}
