<?php

namespace App\Services;

use App\ControlledProcess;
use App\Repositories\ControlledProcessRepository;

class ControlledProcessService extends Services {

    private $controlledProcessRepository;

    public function __construct(ControlledProcessRepository $controlledProcessRepository) {
        $this->controlledProcessRepository = $controlledProcessRepository;
    }

    public function add($controlledProcess) {
        return $this->controlledProcessRepository->save($controlledProcess);
    }

    public function read($id) {
        $controlledProcess = $this->projectRepository->read($id);
        if (is_null($controlledProcess)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $controlledProcess;
    }

    public function edit($controlledProcess) {
        return $controlledProcess;
    }

    public function delete($id) {
        $controlledProcessDeleted = ControlledProcess::destroy($id);
        if ($controlledProcessDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

}
