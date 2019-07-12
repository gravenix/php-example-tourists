<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\FlightController;
use App\Flight;
use Illuminate\Http\Request;

class FlightControllerTest extends TestCase
{
    /**
     * Adding test.
     *
     * @return void
     */
    public function testAdding()
    {
        //create flight
        $flight = factory(Flight::class)->create();

        $controller = new FlightController();
        //empty
        $request = Request::create('/api/flight/'.$flight->id, 'POST', array());
        $response = $controller->updateFlight($request, $flight->id);
        $this->assertEquals(200, $response->getStatusCode());
        
        //example req
        $request = Request::create(route('api.updateflight', [ 'id' => $flight->id ]), 'POST', array(
            'seats' => 100,
            'price' => 200.0,
        ));
        $response = $controller->updateFlight($request, $flight->id);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
