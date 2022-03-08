<?php

namespace App\Services;

use App\SystemGoal;
use App\Repositories\SystemGoalRepository;

class SystemGoalService extends Services
{

    private $systemGoalRepository;

    public function __construct(SystemGoalRepository $systemGoalRepository)
    {
        $this->systemGoalRepository = $systemGoalRepository;
    }

    public function add(SystemGoal $systemGoal)
    {
        return $this->systemGoalRepository->add($systemGoal);
    }
    
    public function read($id)
    {
        $systemgoal = $this->systemGoalRepository->read($id);
        if (is_null($systemgoal)) {
            return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
        }
        return $systemgoal;
    }
    
    public function edit($systemGoal)
    {
        return $this->systemGoalRepository->update($systemGoal);
    }

    public function delete($id)
    {
        $systemgoalDeletado = $this->systemGoalRepository->delete($id);
        if ($systemgoalDeletado) {
            return response()->json(['Resposta' => 'Ojeto deletado com sucesso'], 200);
        }
        return response()->json(['Resposta' => 'Ojeto nao encontrado'], 404);
    }

    public static function mapGoals($project_id)
    {
        $sysgoals = SystemGoal::where('project_id', $project_id)->orderBy('id')->get();
        $index = 0;

        $sysgoal_map = null;

        foreach ($sysgoals as $sysgoal) {
            $sysgoal_map[$sysgoal->id] = ++$index;
        }
        return $sysgoal_map;
    }
}
