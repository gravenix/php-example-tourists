<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class AdminApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAsAdmin()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
            'lastname' => 'testovski', 
            'birth_day' => '2002-02-02', 
            'sex' => 'man', 
            'email' => 'aaa@aaa.aa', 
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'country' => 'Poland',
            'role' => 'admin']);
        $response = $this->actingAs($user)->get(route('api.users'));
        $response->assertStatus(200);
    }

    public function testAsUser(){
        $response = $this->get(route('api.users'));
        $response->assertStatus(302);
    }
}
