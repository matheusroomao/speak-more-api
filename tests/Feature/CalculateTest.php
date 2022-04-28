<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_calculate_in_admin()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $plans = [1,2,3];
        $data = [
            "origin" => 4, 
            "destiny" => 2,
            "time" => $faker->numerify(),
            "plan_id" => $plans[array_rand($plans)]
        ];
        $response = $this->postJson('/api/calculate/', $data);
        $response->assertSuccessful();
    }
    public function test_if_calculate_validation_in_admin()
    {
        $data = [];
        $response = $this->postJson('/api/calculate/', $data);
        $response->assertUnprocessable();
    }
}
