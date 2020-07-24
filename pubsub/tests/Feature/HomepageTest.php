<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testDox All feature tests for the homepage ('/')
 */
class HomepageTest extends TestCase
{
    /**
     * @test
     * @group Homepage
     * @testDox Confirm that the homepage resolves (ie. a GETY request returns a HTTP status code of 200)
     * @return void
     */
    public function homepageResolves()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
