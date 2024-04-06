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
    public function test_example()
    {

        $responseIndex = $this->get('/');
        $responseIndex->assertStatus(200);

        $responseAttendance = $this->get('/attendance');
        $responseAttendance->assertStatus(200);

        $responseIndex = $this->get('/register');
        $responseIndex->assertStatus(200);

        $responseIndex = $this->get('/login');
        $responseIndex->assertStatus(200);
    }
}
