<?php

namespace App\Services;

use App\Repositories\ComponentRepository;

class ComponentService extends Services
{

    public function __construct(ComponentRepository $componentRepository)
    {
        $this->componentRepository = $componentRepository;
    }

    private $componentRepository;

    public function add($component)
    {
        return $this->componentRepository->add($component);
    }

    public function delete($id)
    {
        $componentDeletado = $this->componentRepository->delete($id);
        if ($componentDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }
}
