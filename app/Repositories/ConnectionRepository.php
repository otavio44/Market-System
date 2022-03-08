<?php

namespace App\Repositories;

use App\Connection;
use App\Repositories\Repository;

class ConnectionRepository extends Repository
{

    public function add($connection)
    {
        parent::save($connection);
        return Connection::where('id', Connection::max('id'))->with('input', 'output')->get()->first();
    }

    public function delete($id)
    {
        return Connection::destroy($id);
    }

    public function update($model)
    {
    }

    public function read($id)
    {
    }
}
