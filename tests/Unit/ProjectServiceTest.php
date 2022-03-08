<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ProjectService;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use App\Project;
use App\User;
use Mockery;

class ProjectServiceTest extends TestCase {

    public $project;
    public $projectWithUsers;
    public $user;

    /**
     * @before
     */
    public function setUp() : void { 
        parent::setUp();
        
        $this->user = new User();
        $this->user->id = 1;
        $this->user->name = "Fellipe Guilherme Rey de Souza";
        $this->user->email = "teste@teste.com.br";
        $this->user->created_at = "2018-04-26 09:33:47";
        $this->user->updated_at = "2018-10-24 20:58:25";

        $this->project = new Project();
        $this->project->id = 17;
        $this->project->name = "Name Test";
        $this->project->created_at = "2020-04-05 15:40:11";
        $this->project->update_at  = "2020-04-05 15:40:11";        
        $this->project->URL = "Name-Test-17";
        $this->project->type = "Security";
        
        $this->projectWithUsers = clone $this->project;
        $this->projectWithUsers->users = [$this->user];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_project()
    {
        // Create a mock to ProjectRepository class.
        $project_repository = $this->instance(ProjectRepository::class, Mockery::mock(ProjectRepository::class, function ($mock) {
            $mock->shouldReceive('add')->once();
        }));

        $project_repository->add($this->project);
    }

}
