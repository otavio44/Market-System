<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Hazard;
use App\Services\SystemGoalService;
use App\Repositories\SystemGoalRepository;
use App\Project;
use App\SystemGoal;

class ISystemGoalServiceTest extends TestCase {

    use DatabaseTransactions;

    public $project;

    public function setUp() : void { 
        parent::setUp();

        //Aqui são os Projetos e system_goals que o hazard estará associados nas operações CRUD. 
        $this->project = new Project();
        $this->project->name = "Name Project Test";
        $this->project->URL = "Name-Test-IdX";
        $this->project->type = "Security";
        $this->project->save();   
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_create_system_goal_on_database() {
        $systemGoalInsert = new SystemGoal();
        $systemGoalInsert->name = "Name SystemGoal Test";
        $systemGoalInsert->project_id = $this->project->id;    
        

        $systemGoalService = new SystemGoalService(new SystemGoalRepository());
        $SystemGoalSaveDataBase = $systemGoalService->add($systemGoalInsert);
        
        $this->seeInDatabase("system_goals", [
            'name' => $systemGoalInsert->name
        ]);
        
        $this->assertEquals($systemGoalInsert->name, $SystemGoalSaveDataBase->name);
    }

    
    public function test_read_system_goal_on_database() {
        $systemGoalInsert = new SystemGoal();
        $systemGoalInsert->name = "Name SystemGoal Test";
        $systemGoalInsert->project_id = $this->project->id;    
        

        $systemGoalService = new SystemGoalService(new SystemGoalRepository());
        $SystemGoalSaveDataBase = $systemGoalService->add($systemGoalInsert);

        $systemGoalReadDataBase = $systemGoalService->read($SystemGoalSaveDataBase->id);
        $this->assertEquals($SystemGoalSaveDataBase->id, $systemGoalReadDataBase->id);
    }

    
    public function test_update_system_goal_on_database() {
        $systemGoalInsert = new SystemGoal();
        $systemGoalInsert->name = "Name SystemGoal Test";
        $systemGoalInsert->project_id = $this->project->id;    
        

        $systemGoalService = new SystemGoalService(new SystemGoalRepository());
        $SystemGoalSaveDataBase = $systemGoalService->add($systemGoalInsert);

        $SystemGoalSaveDataBase->name = "Name SystemGoal Edit Test";

        $systemGoalService->edit($SystemGoalSaveDataBase);

        $this->seeInDatabase("system_goals", [
            'name' => "Name SystemGoal Edit Test",
        ]);
    }

    
    public function test_delete_system_goal_on_database() {
        $systemGoalInsert = new SystemGoal();
        $systemGoalInsert->name = "Name SystemGoal Test";
        $systemGoalInsert->project_id = $this->project->id;    
        

        $systemGoalService = new SystemGoalService(new SystemGoalRepository());
        $SystemGoalSaveDataBase = $systemGoalService->add($systemGoalInsert);
        
        $systemGoalService->delete($SystemGoalSaveDataBase->id);
        
        $this->missingFromDatabase("system_goals", [
            'name' => $systemGoalInsert->name
        ]);
    }

}
