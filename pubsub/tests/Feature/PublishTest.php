<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublishTest extends TestCase
{
    /**
     * @test
     * @group Publish
     * @testDox Confirm that the Publish endpoint does not resolve for a GET request, with or without a topic in the URL
     * @return void
     */
    public function publishEndpointGetRequestDoesNotResolve()
    {
        $response = $this->get('/publish');
        $response->assertStatus(404);

        $response = $this->get('/publish/testtopic');
        $response->assertStatus(404);
    }
}
