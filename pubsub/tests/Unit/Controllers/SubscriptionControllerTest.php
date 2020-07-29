<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use WithoutMiddleware;

    public $mockRepository;

    public function setUp() : void
    {
        parent::setUp();
        $this->mockRepository = Mockery::mock('App\Repositories\SubscriptionRepositoryInterface');
    }

    public function tearDown() : void
    {
        Mockery::close();
        parent::tearDown();
    }


    /**
     * @test
     * @group Controllers
     * @testDox A request to the subscribe endpoint without the URL parameter should result in an error in session for the 'url' key, no calls to the repository's "create" method, and should redirect the response
     *
     * @return void
     */
    public function subscribeRequestWithEmptyUrlIsInvalid()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('create')
            // set expectations - the create method should never be called (due to validation check)
            ->times(0);

        // register the mock repository
        $this->app->instance('App\Repositories\SubscriptionRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/subscribe/testtopic', [
            'url' => ''
        ]);

        // assertions
        $responseObject->assertSessionHasErrors('url');
        $responseObject->assertStatus(302);
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the subscribe endpoint without the URL parameter should result in an error in session for the 'url' key, no calls to the repository's "create" method, and should redirect the response
     *
     * @return void
     */
    public function subscribeRequestWithNoUrlParameterIsInvalid()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('create')
            // set expectations - the create method should never be called (due to validation check)
            ->times(0);

        // register the mock repository
        $this->app->instance('App\Repositories\SubscriptionRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/subscribe/testtopic');

        // assertions
        $responseObject->assertSessionHasErrors('url');
        $responseObject->assertStatus(302);
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the subscribe endpoint with a non-empty URL parameter should result in a single call to the repository's "create" method, and there should be no validation errors in session
     *
     * @return void
     */
    public function subscribeRequestWithUrlParameterIsValid()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('create')
            ->with([
                'url' => 'someValidURL',
                'topic' => 'testtopic'
            ])
            // set expectations - the create method should be called once
            ->once();

        // register the mock repository
        $this->app->instance('App\Repositories\SubscriptionRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/subscribe/testtopic', [
            'url' => 'someValidURL'
        ]);

        // assertions
        $responseObject->assertSessionHasNoErrors();
        $responseObject->assertOk();
    }
}
