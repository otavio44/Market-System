<?php
 
namespace Tests\EndToEnd;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
 
class AccessHomeTest extends TestCase
{

    /**
     * See title.
     *
     * @return void
     */
    public function testSeeName()
    {
        $this->visit('/')
            ->see('About STAMP/STPA')
            ->dontSee('Error');
    }
}
