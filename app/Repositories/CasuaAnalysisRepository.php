<?php

namespace App\Repositories;

use App\CasuaAnalysis;
use App\Repositories\Repository;

class CasuaAnalysisRepository extends Repository {

    public function add($casual) {
        parent::save($casual);
        return CasuaAnalysis::where('id', CasuaAnalysis::max('id'))->with('guideword')->get()->first();
    }

    public function read($id) {
        return CasuaAnalysis::where('id', $id)->with('guideword')->get()->first();
    }

    public function update($casual) {
        $casual->save();
        return CasuaAnalysis::where('id', $casual->id)->with('guideword')->get()->first();
    }

    public function delete($id) {
        return CasuaAnalysis::destroy($id);
    }

}
