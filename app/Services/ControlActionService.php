<?php

namespace App\Services;

use App\Repositories\ControlActionRepository;

class ControlActionService extends Services {

    private $controlActionRepository;

    public function __construct(ControlActionRepository $controlActionRepository) {
        $this->controlActionRepository = $controlActionRepository;
    }

    public function add($controlAction) {
        return $this->controlActionRepository->add($controlAction);
    }

    public function delete($id) {
        $controlactionDeletado = $this->controlActionRepository->delete($id);
        if ($controlactionDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

}
