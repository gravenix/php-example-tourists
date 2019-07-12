<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Flight;
use App\User;

class FlightsTest extends TestCase
{
    use WithFaker;
    protected $user;

    protected function setUp() :void{
        parent::setUp();
        $this->user = factory(User::class)->create([
            'role' => 'admin'
        ]);
    }

    /**
     * Adding new flight api test.
     *
     * @return void
     */
    public function test_add_flight()
    {
        $response = $this->actingAs($this->user)->json('POST', route('api.addflight'), [
            'departure_time' => '2019-08-12 11:15',
            'arrival_time' => '2019-08-12 19:45',
            'seats' => 200,
            'price' => 89.99
        ]);
        
        $response->assertStatus(201)
                ->assertJson([
                    'created' => true,
                ]);
    }

    /**
     * Removing flight test api
     */
    public function test_remove_flight_api(){
        //add a flight to database
        $flight = factory(Flight::class)->create();

        //no id passed
        $response = $this->actingAs($this->user)->json('DELETE', route('api.delflight'));
        $response->assertStatus(200)
            ->assertJson([
                'deleted' => false
            ]);

        //non existent record
        $response = $this->actingAs($this->user)->json('DELETE', route('api.delflight'), [
            'id' => 9999
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'deleted' => false
            ]);
            
        //correct id
        $response = $this->actingAs($this->user)->json('DELETE', route('api.delflight'), [
            'id' => $flight->id
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'deleted' => true
            ]);
    }

    /**
     * Updating flights through api
     */
    public function test_update_flight_api(){
        //create flight
        $flight = factory(Flight::class)->create();

        //update all info
        $response = $this->actingAs($this->user)->json('POST', route('api.updateflight', [ 'id' => $flight->id ]), [
            'departure_time' => $this->faker->dateTimeInInterval('now', '+ 15 minutes')->format('Y-m-d H:i:s'),
            'arrival_time' => $this->faker->dateTimeInInterval('+ 5 hours', '+ 15 minutes')->format('Y-m-d H:i:s'),
            'seats' => 100,
            'price' => 200.0,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'updated' => true
            ]);

        //non digit entered
        $response = $this->actingAs($this->user)->json('POST', route('api.updateflight', [ 'id' => 'asdwa' ]), [
            'seats' => 100,
            'price' => 200.0,
        ]);
        $response->assertStatus(404);

        //update without params
        $response = $this->actingAs($this->user)->json('POST', route('api.updateflight', [ 'id' => $flight->id ]));
        $response->assertStatus(200)
            ->assertJson([
                'updated' => true
            ]);

        //update some info of existing
        $response = $this->actingAs($this->user)->json('POST', route('api.updateflight', [ 'id' => $flight->id ]), [
            'seats' => 100,
            'price' => 200.0,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'updated' => true
            ]);

        //update with non existent id
        $response = $this->actingAs($this->user)->json('POST', route('api.updateflight', [ 'id' => 99999 ]), [
            'seats' => 100,
            'price' => 200.0,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'updated' => false
            ]);
    }

    /**
     * Basic reading flights
     */
    public function test_read_flights(){
        $flights = factory(Flight::Class, 3)->create();
        $response = $this->actingAs($this->user)->get(route('api.flights'));
        $response->assertStatus(200);
    }
}
