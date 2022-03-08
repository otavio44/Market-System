<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ControllerService;
use App\Repositories\ControllerRepository;
use App\Controller;
use App\Project;
use Mockery;

class ControllerServiceTest extends TestCase {

    public $project;
    public $controller;

    /**
     * @before
     */
    public function setUp() : void { 
        parent::setUp();

        $this->project = new Project();
        $this->project->id = 17;
        $this->project->name = "Name Test";
        $this->project->created_at = "2020-04-05 15:40:11";
        $this->project->update_at  = "2020-04-05 15:40:11";        
        $this->project->URL = "Name-Test-17";
        $this->project->type = "Security";

        //Mocks de retorno
        $this->controller = new Controller();
        $this->controller->name = "Name Controller Test";
        $this->controller->type = "Automatized";
        $this->controller->project_id = 17;
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_controller()
    {
        // Create a mock to ControllerRepository class.
        $controller_repository = $this->instance(ControllerRepository::class, Mockery::mock(ControllerRepository::class, function ($mock) {
            $mock->shouldReceive('add')->once();
        }));

        $controller_repository->add($this->controller);
    }
}