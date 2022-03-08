<?php

namespace App\Services;

use App\Repositories\SensorRepository;

class SensorService extends Services {

    public function __construct(SensorRepository $sensorRepository) {
        $this->sensorRepository = $sensorRepository;
    }

    private $sensorRepository;

    public function add($sensor) {
        return $this->sensorRepository->add($sensor);
    }

    public function read($id) {
        $sensor = $this->sensorRepository->read($id);
        if (is_null($sensor)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $sensor;
    }

    public function delete($id) {
        $sensorDeletado = $this->sensorRepository->delete($id);
        if ($sensorDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function edit($sensor) {
        return $this->sensorRepository->update($sensor);
    }

}
