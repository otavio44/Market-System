<?php

namespace App\Services;

use App\CausalAnalysis;
use Illuminate\Routing\Redirector;

class CausalAnalysisServices extends Services
{

    private $casualAnalysisRepository;

    public function __construct(CasuaAnalysisRepository $casualAnalysisRepository)
    {
        $this->casualAnalysisRepository = $casualAnalysisRepository;
    }

    public function add($causal)
    {
        parent::save($causal);
        return $this->casualAnalysisRepository->add($causal);
    }

    public function read($id)
    {
        $casualanalysis = $this->casualAnalysisRepository->read($id);
        if (is_null($casualanalysis)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $casualanalysis;
    }

    public function edit($causal)
    {
        return $this->casualAnalysisRepository->update($causal);
    }

    public function delete($id)
    {
        $casualanalysisdeletado = $this->casualAnalysisRepository->delete($id);
        if ($casualanalysisdeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    //colocar delete cascade
    public function deleteAll($id)
    {
        CausalAnalysis::where("safety_constraint_id", $id)->delete();
    }
}
