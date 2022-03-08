<?php

namespace App\Repositories;

abstract class Repository
{

    abstract public function add($model);

    abstract public function read($id);

    abstract public function update($model);

    abstract public function delete($model);

    public function save($m)
    {
        $m->save();
    }
}
