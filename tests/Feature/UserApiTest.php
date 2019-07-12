<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\User;

class UserApiTest extends TestCase
{
    protected $user;

    protected function setUp() :void{
        parent::setUp();
        $this->user = factory(User::class)->create([
            'role' => 'admin'
        ]);
    }

    /**
     * A API user add test.
     *
     * @return void
     */
    public function test_user_adding_api()
    {
        $data = array(
            'email' => 'email@example.com',
            'password' => 'qwerty', //plain text password
            'password_confirmation' => 'qwerty',
            'name' => 'Jan',
            'lastname' => 'Kowalikowski',
            'sex' => 'man',
            'country' => 'Polska',
            'birth_day' => '1995-02-14',

        );
        $response = $this->actingAs($this->user)->post('/api/user', $data);
        $response->assertStatus(201);

        $result = DB::table('users')->where('email', $data['email'])->get();
        $this->assertNotEmpty($result);
    }

    public function test_removing_user_api(){
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->user)->delete('/api/user/', array('id' => $user->id));
        $response->assertStatus(200)
            ->assertJson(['deleted' => true]);
        
        $result = DB::table('users')->where('email', $user->email)->get();
        $this->assertEmpty($result);
    }
}
