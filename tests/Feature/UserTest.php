<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fill_user_success()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Basic '. base64_encode("{$user->email}:password")
        ])->getJson('/api/fillusers');

        $response->assertStatus(200);
    }

    public function test_get_users()
    {
        
        $user = \App\Models\User::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Basic '. base64_encode("{$user->email}:password")
        ])->getJson('/api/users?page=0');
        
        $this->assertEquals(200, $response->getStatusCode());
        
    }

    public function test_users_page_not_found()
    {
        
        $user = \App\Models\User::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Basic '. base64_encode("{$user->email}:password")
        ])->getJson('/api/Uusers?page=5');

        $response->assertNotFound();
    }
    
    
}
