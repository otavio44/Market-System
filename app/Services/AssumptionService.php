<?php

namespace App\Services;

use App\Assumption;
use App\Repositories\AssumptionRepository;

class AssumptionService extends Services {

    public function __construct(AssumptionRepository $assumptionRepository) {
        $this->assumptionRepository = $assumptionRepository;
    }

    private $assumptionRepository;

    public function add(Assumption $assumption) {
        return $this->assumptionRepository->add($assumption);
    }

    public function read($id) {
        $assumption = $this->assumptionRepository->read($id);
        if (is_null($assumption)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $assumption;
    }

    public function edit(Assumption $assumption) {
        return $this->assumptionRepository->update($assumption);
    }

    public function delete($id) {
        $assumptionDeleted = $this->assumptionRepository->delete($id);

        if ($assumptionDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public static function mapAssumptions($project_id){
        $assumptions = Assumption::where('project_id', $project_id)->orderBy('id')->get();
        $index = 0;

        $assumptions_map = null;

        foreach($assumptions as $assumption) {
            $assumptions_map[$assumption->id] = ++$index;
        }
        return $assumptions_map;
    }

}
