<?php

namespace App\Http;

use App\Team;

trait RoutesTrait
{
    public function mapAssumptions($project_id)
    {
        $assumptions = App\Assumptions::where('project_id', $project_id)->orderBy('id')->get();
        $index = 0;

        $assumptions_map = null;

        foreach ($assumptions as $assumption) {
            $assumptions_map[$assumption->id] = ++$index;
        }
        return $assumptions_map;
    }

    public function mapLoss($losses)
    {
        $index = 0;

        $loss_map = null;

        foreach ($losses as $loss) {
            $loss_map[$loss->id] = ++$index;
        }
        return $loss_map;
    }

    public function mapHazard($project_id)
    {
        $hazards = App\Hazards::where('project_id', $project_id)->orderBy('id')->get();
        $index = 0;

        $hazard_map = null;

        foreach ($hazards as $hazard) {
            $hazard_map[$hazard->id] = ++$index;
        }
        return $hazard_map;
    }

    public function mapGoals($project_id)
    {
        $sysgoals = App\SystemGoals::where('project_id', $project_id)->orderBy('id')->get();
        $index = 0;

        $sysgoal_map = null;

        foreach ($sysgoals as $sysgoal) {
            $sysgoal_map[$sysgoal->id] = ++$index;
        }
        return $sysgoal_map;
    }

    public function mapConstraints($project_id)
    {
        $syscons = App\SystemSafetyConstraints::where('project_id', $project_id)->get();
        $index = 0;

        $syscons_map = null;

        foreach ($syscons as $sysconstraint) {
            $syscons_map[$sysconstraint->id] = ++$index;
        }
        return $syscons_map;
    }
}
