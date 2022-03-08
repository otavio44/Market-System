<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\User;
use App\Services\ProjectService;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;

class IProjectServiceTest extends TestCase {

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_project_on_database() {

        $user = new User();
        $user->name = "Fellipe Guilherme Rey de Souza";
        $user->email = "teste@teste.com.br";
        $user->created_at = "2018-04-26 09:33:47";
        $user->updated_at = "2018-10-24 20:58:25";
        $user->save();

        $projectInsert = new Project();
        $projectInsert->name = "Name Test";
        $projectInsert->type = "Security";
        $projectInsert->URL = "Name-Test-30";
        $projectInsert->users = ["teste@teste.com.br"];

        $projectService = new ProjectService(new ProjectRepository(), new UserRepository());
        $projectSaveDataBase = $projectService->add($projectInsert);

        $this->assertDatabaseHas("projects", [
            'name' => $projectInsert->name
        ]);
        $this->assertEquals($projectInsert->name, $projectSaveDataBase->name);
        $this->assertEquals($projectInsert->users[0]->email, $projectSaveDataBase->users[0]->email);
    }
    
    public function test_read_project_on_database() {

        $user = new User();
        $user->name = "Fellipe Guilherme Rey de Souza";
        $user->email = "teste@teste.com.br";
        $user->created_at = "2018-04-26 09:33:47";
        $user->updated_at = "2018-10-24 20:58:25";
        $user->save();

        $projectInsert = new Project();
        $projectInsert->name = "Name Test";
        $projectInsert->type = "Security";
        $projectInsert->URL = "Name-Test-30";
        $projectInsert->users = ["teste@teste.com.br"];

        $projectService = new ProjectService(new ProjectRepository(), new UserRepository());
        $projectSavedDataBase = $projectService->add($projectInsert);
        $projectReadDataBase = $projectService->read($projectSavedDataBase->id);
        $this->assertEquals($projectSavedDataBase->id, $projectReadDataBase->id);
    }

    public function test_update_project_on_database() {

        $user = new User();
        $user->name = "Fellipe Guilherme Rey de Souza";
        $user->email = "teste@teste.com.br";
        $user->created_at = "2018-04-26 09:33:47";
        $user->updated_at = "2018-10-24 20:58:25";
        $user->save();

        $projectInsert = new Project();
        $projectInsert->name = "Name Test";
        $projectInsert->type = "Security";
        $projectInsert->URL = "Name-Test-30";
        $projectInsert->users = ["teste@teste.com.br"];
        
        $projectService = new ProjectService(new ProjectRepository(), new UserRepository());
        $projectSavedDataBase = $projectService->add($projectInsert);

        $projectSavedDataBase->name = "Name Edit Test";

        $projectService->edit($projectSavedDataBase);

        $this->assertEquals($projectSavedDataBase->name, "Name Edit Test");
    }
    
    public function test_delete_project_on_database() {

        $user = new User();
        $user->name = "Fellipe Guilherme Rey de Souza";
        $user->email = "teste@teste.com.br";
        $user->created_at = "2018-04-26 09:33:47";
        $user->updated_at = "2018-10-24 20:58:25";
        $user->save();

        $projectInsert = new Project();
        $projectInsert->name = "Name Test";
        $projectInsert->type = "Security";
        $projectInsert->URL = "Name-Test-30";
        $projectInsert->users = ["teste@teste.com.br"];
        
        $projectService = new ProjectService(new ProjectRepository(), new UserRepository());
        $projectSavedDataBase = $projectService->add($projectInsert);
        
        $projectService->delete($projectSavedDataBase->id);
        
        $this->missingFromDatabase("projects", [
            'name' => $projectInsert->name
        ]);
    }

}
