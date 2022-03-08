<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Hazard;
use App\Services\LossService;
use App\Repositories\LossRepository;
use App\Project;
use App\Loss;

class ILossServiceTest extends TestCase {

    use DatabaseTransactions;

    public $project;
    public $hazard;

    public function setUp() : void { 
        parent::setUp();

        //Aqui são os Projetos e Losses que o hazard estará associados nas operações CRUD. 
        $this->project = new Project();
        $this->project->name = "Name Project Test";
        $this->project->URL = "Name-Test-IdX";
        $this->project->type = "Security";
        $this->project->save();

        $this->hazard = new Hazard();
        $this->hazard->name = "Name Loss Test";
        $this->hazard->project_id = $this->project->id;    
        $this->hazard->save();       
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_loss_on_database() {
        $lossInsert = new Loss();
        $lossInsert->name = "Name Loss Test";
        $lossInsert->project_id = $this->project->id;     

        $lossService = new LossService(new LossRepository());
        $lossSaveDataBase = $lossService->add($lossInsert);
        
        $this->seeInDatabase("losses", [
            'name' => $lossInsert->name
        ]);
        
        $this->assertEquals($lossInsert->name, $lossSaveDataBase->name);
    }
 
    public function test_read_loss_on_database() {
        $lossInsert = new Loss();
        $lossInsert->name = "Name Loss Test";
        $lossInsert->project_id = $this->project->id;    

        $lossService = new LossService(new LossRepository());
        $lossSaveDataBase = $lossService->add($lossInsert);

        $lossReadDataBase = $lossService->read($lossSaveDataBase->id);
        $this->assertEquals($lossSaveDataBase->id, $lossReadDataBase->id);
    }
    
    public function test_update_loss_on_database() {
        $lossInsert = new Loss();
        $lossInsert->name = "Name Loss Test";
        $lossInsert->project_id = $this->project->id;    

        $lossService = new LossService(new LossRepository());
        $lossSaveDataBase = $lossService->add($lossInsert);

        $lossSaveDataBase->name = "Name Loss Edit Test";

        $lossService->edit($lossSaveDataBase);

        $this->seeInDatabase("losses", [
            'name' => "Name Loss Edit Test",
        ]);
    }
    
    public function test_delete_loss_on_database() {
        $lossInsert = new Loss();
        $lossInsert->name = "Name Loss Test";
        $lossInsert->project_id = $this->project->id;    

        $lossService = new LossService(new LossRepository());
        $lossSaveDataBase = $lossService->add($lossInsert);

        $lossService->delete($lossSaveDataBase->id);

        $this->missingFromDatabase("losses", [
            'name' => $lossInsert->name
        ]);
    }

}
