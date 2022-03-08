<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Hazard;
use App\Services\ControllerService;
use App\Repositories\ControllerRepository;
use App\Project;
use App\Controller;

class IControllerServiceTest extends TestCase {

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
    public function test_create_controller_on_database() {
        $controllerInsert = new Controller();
        $controllerInsert->name = "Name Controller Test";
        $controllerInsert->type = "Automatized";   
        $controllerInsert->project_id = $this->project->id;   

        $controllerService = new ControllerService(new ControllerRepository());
        $SystemGoalSaveDataBase = $controllerService->add($controllerInsert);
        
        $this->seeInDatabase("controllers", [
            'name' => $controllerInsert->name
        ]);
        
        $this->assertEquals($controllerInsert->name, $SystemGoalSaveDataBase->name);
    }
    
    public function test_read_controller_on_database() {
        $controllerInsert = new Controller();
        $controllerInsert->name = "Name Controller Test";
        $controllerInsert->type =  "Automatized"; 
        $controllerInsert->project_id = $this->project->id;    
        

        $controllerService = new ControllerService(new ControllerRepository());
        $ControllerSaveDataBase = $controllerService->add($controllerInsert);

        $controllerReadDataBase = $controllerService->read($ControllerSaveDataBase->id);
        $this->assertEquals($ControllerSaveDataBase->id, $controllerReadDataBase->id);
    }
    
    public function test_update_controller_on_database() {
        $controllerInsert = new Controller();
        $controllerInsert->name = "Name Controller Test";
        $controllerInsert->type =  "Automatized";    
        $controllerInsert->project_id = $this->project->id;    
        

        $controllerService = new ControllerService(new ControllerRepository());
        $controllerSaveDataBase = $controllerService->add($controllerInsert);

        $controllerSaveDataBase->name = "Name Controller Edit Test";

        $controllerService->edit($controllerSaveDataBase);

        $this->seeInDatabase("controllers", [
            'name' => "Name Controller Edit Test",
            'type' => "Automatized"
        ]);
    }
    
    public function test_delete_controller_on_database() {
        $controllerInsert = new Controller();
        $controllerInsert->name = "Name Controller Test";
        $controllerInsert->type =  "Automatized";   
        $controllerInsert->project_id = $this->project->id;    
        
        $controllerService = new ControllerService(new ControllerRepository());
        $ControllerSaveDataBase = $controllerService->add($controllerInsert);
        
        $controllerService->delete($ControllerSaveDataBase->id);
        
        $this->missingFromDatabase("system_goals", [
            'name' => $controllerInsert->name
        ]);
    }
}
