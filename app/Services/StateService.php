<?php

namespace App\Services;

use App\Repositories\StateRepository;

class StateService extends Services
{

    private $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function add($state)
    {
        return $this->stateRepository->add($state);
    }

    public function delete($id)
    {
        $stateDeletado = $this->stateRepository->delete($id);
        if ($stateDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }
}
