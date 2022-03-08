<?php

namespace App\Services;

use App\Repositories\RuleRepository;

class RuleService extends Services {

    public function __construct(RuleRepository $ruleRepository) {
        $this->ruleRepository = $ruleRepository;
    }

    private $ruleRepository;

    public function add($rule) {
        return $this->ruleRepository->add($rule);
    }

    public function delete($id) {
        $ruleDeletado = $this->ruleRepository->delete($id);
        if ($ruleDeletado) {
            return response()->json(['Resposta' => 'Ojetos deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojetos nao encontrado'], 404);
    }

}
