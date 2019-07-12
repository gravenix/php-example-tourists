<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Flight;
use App\User;

class FlightsTest extends TestCase
{
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
     * Basic reading flights
     */
    public function test_read_flights(){
        $flights = factory(Flight::Class, 3)->create();
        $response = $this->actingAs($this->user)->get(route('api.flights'));
        $response->assertStatus(200);
    }
}
