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
     * @testDox An empty URL in a subscription request should return null
     *
     * @return void
     */
    public function subscribeRequestWithEmptyUrlIsInvalid()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('create')
            ->with([
                'url' => '',
            ])
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
}
