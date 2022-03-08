<?php

namespace App\Services;

use App\GuideWord;
use App\User;
use App\Repositories\GuideWordRepository;

class GuideWordService extends Services {

    public function __construct(GuideWordRepository $guideWordRepository) {
        $this->guideWordRepository = $guideWordRepository;
    }

    private $guideWordRepository;

    public function add(GuideWord $guideWord) {
        return $this->add($guideWord);
    }

    public function read($id) {
        $guideWord = $this->guideWordRepository->read($id);
        if (is_null($guideWord)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $guideWord;
    }

    public function edit(GuideWord $guideWord) {
        return $this->guideWordRepository->update($guideWord);
    }

    public function delete($id) {
        $guideWordDeleted = $this->guideWordRepository->delete($id);

        if ($guideWordDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

}
