<?php

namespace App\Services;


use App\Repositories\SafetyConstraintRepository;

class SafetyConstraintService extends Services {

    private $safetyConstraintRepository;

    public function __construct(SafetyConstraintRepository $safetyConstraintRepository) {
        $this->safetyConstraintRepository = $safetyConstraintRepository;
    }

    public function add($safetyConstraint) {
        return $this->safetyConstraintRepository->add($safetyConstraint);
    }

    public function read($id) {
        $safety_constraint = $this->safetyConstraintRepository->read($id);
        if (is_null($safety_constraint)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $safety_constraint;
    }

    
    public function edit($safety_constraint) {
        return $this->safetyConstraintRepository->update($safety_constraint);
    }

    public function delete($id) {
        $safety_constraintDeleted = $this->safetyConstraintRepository->delete($id);
        if ($safety_constraintDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    
}
