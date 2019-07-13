<?php

namespace Tests\Unit;

use App\User;
use App\Flight;
use Tests\TestCase;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\FlightUserController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlightUserRelationTest extends TestCase
{
    /**
     * Test if users can get more seats then it is in the plane.
     *
     * @return void
     */
    public function test_seats_overflow()
    {
        $controller = new FlightUserController;
        $this->assertNotNull($controller);

        //create flight with 150 seats
        $flight = factory(Flight::class)->create([
            'seats' => 150
        ]);
        //create 160 users
        $users = factory(User::class, 160)->create();
        $this->assertCount(160, $users);

        $i = 0; //counter
        foreach ($users as $user) {
            $request = Request::create(route('api.addtoflight', [
                'flight_id' => $flight->id,
                'user_id' => $user->id,
            ]), 'POST');
            $response = $controller->addRelation($request, $flight->id, $user->id);
            if($i++<150){ //there's only 150 seats
                $this->assertEquals(200, $response->getStatusCode());
            } else{ //u can't go
                $this->assertEquals(307, $response->getStatusCode());
            }
        }

        
    }
}
