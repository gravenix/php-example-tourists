<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Flight;
use App\User;

class FlightUserRelationApiTest extends TestCase
{
    /**
     * Test adding currently logged user to a flight.
     *
     * @return void
     */
    public function test_add_signedin_user()
    {
        $flight = factory(Flight::class)->create();
        $user = factory(User::class)->create();

        /**
         * Only flight id given; Assign current user to a flight
         */
        $response = $this->actingAs($user)->post(route('api.addtoflight', ['flight_id' => $flight->id]));
        $response->assertStatus(200);
    }

    
    /**
     * Test adding random user to a flight. (Admin Dashboard)
     *
     * @return void
     */
    public function test_add_user_to_flight()
    {
        $flight = factory(Flight::class)->create();
        $user = factory(User::class)->create();

        /**
         * Given id of an user and id of a flight
         */
        $response = $this->actingAs($user)->post(route('api.addtoflight', [
            'flight_id' => $flight->id,
            'user_id' => $user->id
        ]));
        $response->assertStatus(200);
    }
}
