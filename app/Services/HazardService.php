<?php

namespace App\Services;

use App\Hazard;
use Illuminate\Routing\Redirector;
use App\Repositories\HazardRepository;

class HazardService extends Services {

    private $hazardRepository;

    public function __construct(HazardRepository $hazardRepository) {
        $this->hazardRepository = $hazardRepository;
    }

    public function add($hazard, $project_type) {
        $hazardSaved = $this->hazardRepository->add($hazard);
        $hazardSaved->project_type = $project_type;
        return $hazardSaved;
    }

    public function read($id) {
        $hazard = $this->hazardRepository->read($id);
        if (is_null($hazard)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $hazard;
    }

    public function edit($hazard) {
        return $this->hazardRepository->update($hazard);
    }

    public function delete($id) {
        $hazardDeleted = $this->hazardRepository->delete($id);

        if ($hazardDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public function deleteAssociationWithLoss($idHazard, $idLoss){

        $this->hazardRepository->deleteAssociationWithLoss($idHazard, $idLoss);

        $count = count($this->read($idHazard)->losses);

        return response()->json([
            'count' => $count
        ]);
    }

    public static function mapHazard($hazards){
        $index = 0;

        $hazard_map = null;

        foreach($hazards as $hazard) {
            $hazard_map[$hazard->id] = ++$index;
        }
        return $hazard_map;
    }


}
