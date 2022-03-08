<?php

namespace App\Repositories;

use App\GuideWord;
use App\Repositories\Repository;

class GuideWordRepository extends Repository
{

    public function add($guideWord)
    {
        parent::save($guideWord);
        return GuideWord::where('id', GuideWord::max('id'))->get()->first();
    }

    public function read($id)
    {
        return GuideWord::where('id', $id)->get()->first();
    }

    public function update($guideWord)
    {
        $guideWord->save();
        return GuideWord::where('id', $guideWord->id)->get()->first();
    }

    public function delete($id)
    {
        return GuideWord::destroy($id);
    }
}
