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
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
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
        $response->assertStatus(403)
            ->assertJson([
                'status' => 'failed'
            ]);

        //now as an admin
        $user->role = 'admin';
        $user->save();

        $response = $this->actingAs($user)->post(route('api.addtoflight', [
            'flight_id' => $flight->id,
            'user_id' => $user->id
        ]));
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    /**
     * Test if user can assign mutiple times to one flight
     */
    public function test_user_to_one_flight(){
        $user = factory(User::class)->create();
        $flight = factory(Flight::class)->create();

        //try one time
        $response = $this->actingAs($user)->post(route('api.addtoflight', [
            'flight_id' => $flight->id,
        ]));
        $response->assertStatus(200);

        //...and one more
        $response = $this->actingAs($user)->post(route('api.addtoflight', [
            'flight_id' => $flight->id,
        ]));
        $response->assertStatus(403);  
    }
    
    /**
     * Test if users can get more seats then it is in the plane.
     *
     * @return void
     */
    public function test_seats_overflow()
    {
        //create flight with 150 seats
        $flight = factory(Flight::class)->create([
            'seats' => 150
        ]);
        //create 160 users
        $users = factory(User::class, 160)->create();
        $this->assertCount(160, $users);

        $i = 0; //counter
        foreach ($users as $user) {
            $response = $this->actingAs($user)->post(route('api.addtoflight', [
                'flight_id' => $flight->id,
            ]));
            if($i++<150){ //there's only 150 seats
                $response->assertStatus(200);
            } else{ //so you can't go
                $response->assertStatus(403);
            }
        }        
    }

    /**
     * Test deleting user from flight
     * 
     * @return void
     */
    public function test_user_removes_flight(){
        $flight = factory(Flight::class)->create();
        $user = factory(User::class)->create();

        //hardcode attach to a flight
        $flight->users()->attach($user->id);
        $this->assertEquals(1, $flight->users()->count());

        //api call
        $response = $this->actingAs($user)->post(route('api.delfromflight', [
            'flight_id' => $flight->id
        ]));
        $response->assertStatus(200);

        //check id DB
        $this->assertEquals(0, $flight->users()->count());
    }

    /**
     * Test deleting user from flight by admin
     * 
     * @return void
     */
    public function test_user_removed_flight_by_admin(){
        $flight = factory(Flight::class)->create();
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create([
            'role' => 'admin'
        ]);

        //hardcode attach to a flight
        $flight->users()->attach($user->id);
        $this->assertEquals(1, $flight->users()->count());

        //api call
        $response = $this->actingAs($admin)->post(route('api.delfromflight', [
            'flight_id' => $flight->id,
            'user_id' => $user->id,
        ]));
        $response->assertStatus(200);
        
        //check id DB
        $this->assertEquals(0, $flight->users()->count());
    }

    /**
     * Test deleting fake id user 
     * @return void
     */
    public function test_user_removes_flight_fake(){
        $flight = factory(Flight::class)->create();
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create([
            'role' => 'admin'
        ]);

        //hardcode attach to a flight
        $flight->users()->attach($user->id);
        $this->assertEquals(1, $flight->users()->count());

        //api call
        $response = $this->actingAs($admin)->post(route('api.delfromflight', [
            'flight_id' => 5670,
            'user_id' => $user->id,
        ]));
        $response->assertStatus(404);
        
        //check id DB
        $this->assertEquals(1, $flight->users()->count());
    }
}
