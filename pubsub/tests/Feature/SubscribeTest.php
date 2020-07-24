<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testDox All feature tests for the subscribe endpoint ('/subscribe/{topic}')
 */
class SubscribeTest extends TestCase
{
    /**
     * @test
     * @group Subscribe
     * @testDox Confirm that the Subscribe endpoint does not resolve for a GET request, with out without a topic in the URL
     * @return void
     */
    public function subscribeEndpointGetRequestDoesNotResolve()
    {
        $response = $this->get('/subscribe');
        $response->assertStatus(404);

        $response = $this->get('/subscribe/testtopic');
        $response->assertStatus(404);
    }
}
