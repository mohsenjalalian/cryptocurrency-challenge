<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     *
     */
    public function testShow()
    {
        $response = $this->get('/api/orders?tracking_code=c9165852-0d3a-4710-8c20-24cb7e88814c');

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function testStore()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
