<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * @test
     * @group Event Page
     * @testDox Confirm that the Event page resolves (ie. a GET request returns a HTTP status code of 200)
     * @return void
     */
    public function eventPageResolves()
    {
        $response = $this->get('/event');
        $response->assertStatus(200);
    }
}
