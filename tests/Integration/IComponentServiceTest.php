<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Hazard;
use App\Services\ComponentService;
use App\Repositories\ComponentRepository;
use App\Project;
use App\Component;

class IComponentServiceTest extends TestCase {

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
    public function test_create_component_on_database() {
        $componentInsert = new Component();
        $componentInsert->name = "Name Component Test";
        $componentInsert->type = "ControlledProcess";  
        $componentInsert->project_id = $this->project->id;    
        

        $componentService = new ComponentService(new ComponentRepository());
        $ComponentSaveDataBase = $componentService->add($componentInsert);
        
        $this->seeInDatabase("components", [
            'name' => $componentInsert->name
        ]);
        
        $this->assertEquals($componentInsert->name, $ComponentSaveDataBase->name);
    }
    
    public function test_delete_component_on_database() {
        $componentInsert = new Component();
        $componentInsert->name = "Name Component Test";
        $componentInsert->type = "ControlledProcess";  
        $componentInsert->project_id = $this->project->id;    

        $componentService = new ComponentService(new ComponentRepository());
        $ComponentSaveDataBase = $componentService->add($componentInsert);
        
        $componentService->delete($ComponentSaveDataBase->id);
        
        $this->missingFromDatabase("components", [
            'name' => $componentInsert->name
        ]);
    }
}
