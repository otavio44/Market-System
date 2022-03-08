<?php

namespace App\Services;

use App\Repositories\ControllerRepository;

class ControllerService extends Services
{

    private $controllerRepository;

    public function __construct(ControllerRepository $controllerRepository)
    {
        $this->controllerRepository = $controllerRepository;
    }

    public function add($controller)
    {
        return $this->controllerRepository->add($controller);
    }

    public function read($id)
    {
        $controller = $this->controllerRepository->read($id);
        if (is_null($controller)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $controller;
    }

    public function edit($controller)
    {
        return $this->controllerRepository->update($controller);
    }

    public function delete($id)
    {
        $controllerDeletado = $this->controllerRepository->delete($id);
        if ($controllerDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }
}
