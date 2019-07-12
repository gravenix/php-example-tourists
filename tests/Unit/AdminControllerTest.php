<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AdminController;
use App\User;

class AdminControllerTest extends TestCase
{
    /**
     * adding test.
     *
     * @return void
     */
    public function testAdding()
    {
        $controller = new AdminController();
        $request = Request::create('/api/user', 'POST', array(
            'email' => 'email@example.com',
            'password' => 'qwerty', //plain text password
            'password_confirmation' => 'qwerty',
            'name' => 'Jan',
            'lastname' => 'Kowalikowski',
            'sex' => 'man',
            'country' => 'Polska',
            'birth_day' => '1995-02-14',
        ));
        $response = $controller->adduser($request);
        $this->assertEquals(201, $response->getStatusCode());
    }

    /**
     * Test deletion
     */
    public function testDeletion(){
        $controller = new AdminController();
        $user = factory(User::class)->create();
        $this->assertInternalType("int", $user->id);
        $request = Request::create('/api/user', 'DELETE', array(
            'id' => $user->id,
        ));
        $response = $controller->deluser($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertRegExp('/true/', $response);
    }
}
