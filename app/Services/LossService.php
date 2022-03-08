<?php

namespace App\Services;

use App\Loss;
use App\Repositories\LossRepository;
use Illuminate\Routing\Redirector;

class LossService extends Services {

    private $lossRepository;

    public function __construct(LossRepository $lossRepository) {
        $this->lossRepository = $lossRepository;
    }

    public function add($loss) {
        return $this->lossRepository->add($loss);
    }

    public function read($id) {
        $loss = $this->lossRepository->read($id);
        if (is_null($loss)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $loss;
    }

    public function edit($loss) {
        return $this->lossRepository->update($loss);
    }

    public function delete($id) {
        $lossDeleted = $this->lossRepository->delete($id);

        if ($lossDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public static function mapLoss($losses){
        $index = 0;

        $loss_map = null;

        foreach($losses as $loss) {
            $loss_map[$loss->id] = ++$index;
        }
        return $loss_map;
    }

}
