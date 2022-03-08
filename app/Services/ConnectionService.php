<?php

namespace App\Services;

use App\Connection;
use App\Repositories\ConnectionRepository;


class ConnectionService extends Services {

    private $connectionRepository;

    public function __construct(ConnectionRepository $connectionRepository) {
        $this->connectionRepository = $connectionRepository;
    }

    public function add(Connection $connection) {
        return $this->connectionRepository->add($connection);
    }

    public function delete($id) {
        $connectionDeleted = $this->connectionRepository->delete($id);
        if ($connectionDeleted) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

}
