<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class AdminApiTest extends TestCase
{
    /**
     * Test getting all users by api.
     *
     * @return void
     */
    public function testAsAdmin()
    {
        $users = factory(User::class, 10)->create();
        $user = factory(User::class)->create([
            'role' => 'admin'
        ]);
        $response = $this->actingAs($user)->get(route('api.users'));
        $response->assertStatus(200)
                ->assertJsonFragment($user->toArray());
    }

    /**
     * Test getting user as NOT admin (should fail/redirect)
     */
    public function testAsUser(){
        $response = $this->get(route('api.users'));
        $response->assertStatus(302);
    }
}
