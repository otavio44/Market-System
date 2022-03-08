<?php
 
namespace Tests\EndToEnd;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
 
class EndToEndTest extends TestCase
{
    use WithoutMiddleware;

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

    /**
     * Test register user.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->visit('/')
            ->click('Register')
            ->seePageIs('/register')
            ->see('Register')
            ->see('Name')
            ->see('Password')
            ->see('Confirm Password')
            ->type('Name Test 12345', 'name')
            ->type('test_' . rand() .  '@example.com', 'email')
            ->type('12345678', 'password')
            ->type('12345678', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/projects')
            ->see('Projects')
            ->see('Name Test 12345');
    }

}
