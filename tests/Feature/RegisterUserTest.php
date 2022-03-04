<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user_success()
    {
        
        $response = $this->post('/api/register', 
            [
                'email'=>'exemple@gmail.com',
                'name' => 'Sally',
                'gender' => 'male',
                'birthday' => '2015-07-21 02:50:17',
                'country' => 'France',
                'city' => 'Lyon',
                'postcode' => 69000,
                'street_number' => 203,
                'street_name' => 'Jean Mace',
                'coord_lat' => '-38.000',
                'coord_lon' => '10.00',
                'timezone' => 'Paris/Europe',
                'password'=>'password',
            ]
        );

        $response->assertStatus(200);
    }
   
}
