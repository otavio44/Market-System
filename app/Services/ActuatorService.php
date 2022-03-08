<?php

namespace App\Services;

use App\Actuator;
use App\Repositories\ActuatorRepository;

class ActuatorService extends Services {

    public function __construct(ActuatorRepository $actuatorRepository) {
        $this->actuatorRepository = $actuatorRepository;
    }

    private $actuatorRepository;

    public function add(Actuator $actuator) {
        return $this->actuatorRepository->add($actuator);
    }

    public function delete($id) {
        $actuatorDeletado = $this->actuatorRepository->delete($id);
        if ($actuatorDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function edit(Actuator $actuator) {
        return $this->actuatorRepository->update($actuator);
    }

    public function read($id) {
        $actuator = $this->actuatorRepository->read($id);
        if (is_null($actuator)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $actuator;
    }
    
}
