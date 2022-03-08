<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Hazard;
use App\Services\HazardService;
use App\Repositories\HazardRepository;
use App\Project;
use App\Loss;

class IHazardServiceTest extends TestCase {

    use DatabaseTransactions;

    public $project;
    public $loss;

    public function setUp() : void { 
        parent::setUp();

        //Aqui são os Projetos e Losses que o hazard estará associados nas operações CRUD. 
        $this->project = new Project();
        $this->project->name = "Name Project Test";
        $this->project->URL = "Name-Test-IdX";
        $this->project->type = "Security";
        $this->project->save();

        $this->loss = new Loss();
        $this->loss->name = "Name Loss Test";
        $this->loss->project_id = $this->project->id;    
        $this->loss->save();    
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_hazard_on_database() {
        $hazardInsert = new Hazard();
        $hazardInsert->name = "Name Hazard Test";
        $hazardInsert->lossesAssociated = array($this->loss->id);
        $hazardInsert->project_id = $this->project->id;
        $project_type = "type of project";

        $hazardService = new HazardService (new HazardRepository());
        $hazardSaveDataBase = $hazardService->add($hazardInsert, $project_type);
        
        $this->seeInDatabase("hazards", [
            'name' => $hazardInsert->name
        ]);
        
        $this->assertEquals($hazardInsert->name, $hazardSaveDataBase->name);
    } 

    public function test_read_hazard_on_database() {
        $hazardInsert = new Hazard();
        $hazardInsert->name = "Name Hazard Test";
        $hazardInsert->lossesAssociated = array($this->loss->id);
        $hazardInsert->project_id = $this->project->id;
        $project_type = "type of project";

        $hazardService = new HazardService (new HazardRepository());
        $hazardSaveDataBase = $hazardService->add($hazardInsert, $project_type);

        $hazardService = new HazardService(new HazardRepository());
        $hazardSavedDataBase = $hazardService->add($hazardInsert, $project_type);
        $projectReadDataBase = $hazardService->read($hazardSaveDataBase->id);
        $this->assertEquals($hazardSavedDataBase->id, $projectReadDataBase->id);
    }

    
    public function test_update_hazard_on_database() {
        $hazardInsert = new Hazard();
        $hazardInsert->name = "Name Hazard Test";
        $hazardInsert->lossesAssociated = array($this->loss->id);
        $hazardInsert->project_id = $this->project->id;
        $project_type = "type of project";

        $hazardService = new HazardService (new HazardRepository());
        $hazardSaveDataBase = $hazardService->add($hazardInsert, $project_type);
        unset($hazardSaveDataBase->project_type); //retiro essa propriedade, pois ela não pertence ao banco de dados

        $hazardSaveDataBase->name = "Name Hazard Edit Test";

        $hazardService->edit($hazardSaveDataBase);

        $this->assertEquals($hazardSaveDataBase->name, "Name Hazard Edit Test");
    }

    public function test_delete_hazard_on_database() {
        $hazardInsert = new Hazard();
        $hazardInsert->name = "Name Hazard Test";
        $hazardInsert->lossesAssociated = array($this->loss->id);
        $hazardInsert->project_id = $this->project->id;
        $project_type = "type of project";

        $hazardService = new HazardService (new HazardRepository());
        $hazardSaveDataBase = $hazardService->add($hazardInsert, $project_type);
        
        $hazardService->delete($hazardSaveDataBase->id);
        
        $this->missingFromDatabase("hazards", [
            'name' => $hazardInsert->name
        ]);
    }
    
}
