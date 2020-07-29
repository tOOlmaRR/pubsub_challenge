<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use WithoutMiddleware;

    public $mockRepository;

    public function setUp() : void
    {
        parent::setUp();
        $this->mockRepository = Mockery::mock('App\Repositories\EventRepositoryInterface');
    }

    public function tearDown() : void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the Publish endpoint with an empty message should result in an error in session for the 'message' key, no calls to the repository's "create" method, and should redirect the response
     *
     * @return void
     */
    public function publishRequestWithEmptyMessageIsInvalid()
    {
         // mock up the repository
         $this->mockRepository
         ->shouldReceive('create')
         // set expectations - the create method should never be called (due to validation check)
         ->times(0);

        // register the mock repository
        $this->app->instance('App\Repositories\EventRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/publish/testtopic', [
            'message' => ''
        ]);

        // assertions
        $responseObject->assertSessionHasErrors('message');
        $responseObject->assertStatus(302);
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the Publish endpoint with no message parameter should result in an error in session for the 'message' key, no calls to the repository's "create" method, and should redirect the response
     *
     * @return void
     */
    public function publishRequestWithNoMessageParameterIsInvalid()
    {
         // mock up the repository
         $this->mockRepository
         ->shouldReceive('create')
         // set expectations - the create method should never be called (due to validation check)
         ->times(0);

        // register the mock repository
        $this->app->instance('App\Repositories\EventRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/publish/testtopic');

        // assertions
        $responseObject->assertSessionHasErrors('message');
        $responseObject->assertStatus(302);
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the Publish endpoint with a non-empty message should result in a single call to the repository's "create" method, and there should be no validation errors in session
     *
     * @return void
     */
    public function publishRequestWithMessageIsValid()
    {
         // mock up the repository
         $this->mockRepository
         ->shouldReceive('create')
         ->with([
            'message' => 'some test message',
            'topic' => 'testtopic',
        ])
         // set expectations - the create method should be called once
         ->times(1);

        // register the mock repository
        $this->app->instance('App\Repositories\EventRepositoryInterface', $this->mockRepository);

        // now make the API request and capture the response
        $responseObject = $this->call('POST', '/api/v1/publish/testtopic', [
            'message' => 'some test message',
        ]);

        // assertions
        $responseObject->assertSessionHasNoErrors();
        $responseObject->assertOk();
    }

    /**
     * @test
     * @group Controllers
     * @testDox A request to the "allMessagesForCurrentPage" method with an "currentUrl" value should result in a single call to the repository's "view" method, and there should be no validation errors in session
     */
    public function viewRequestWithUrlValueIsValid()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('allMessagesForCurrentPage')
            ->with('http://localhost/event')
            // set expectations - the view method should be called once
            ->times(1);

        // register the mock repository
        $this->app->instance('App\Repositories\EventRepositoryInterface', $this->mockRepository);

        // now make the request and capture the response
        $responseObject = $this->call('GET', '/event', [], [], [], ['localhost']);

        // assertions
        $responseObject->assertSessionHasNoErrors();
        $responseObject->assertOk();
    }

        /**
     * @test
     * @group Controllers
     * @testDox A request to the "allMessagesForCurrentPage" method with "127.0.0.1" value should be treated like localhost
     */
    public function viewRequestWith_127_0_0_1UrlValueTreatedLikeLocalhost()
    {
        // mock up the repository
        $this->mockRepository
            ->shouldReceive('allMessagesForCurrentPage')
            ->with('http://localhost/event')
            // set expectations - the view method should be called once
            ->times(1);

        // register the mock repository
        $this->app->instance('App\Repositories\EventRepositoryInterface', $this->mockRepository);

        // now make the request and capture the response
        $responseObject = $this->call('GET', 'http://127.0.0.1/event');

        // assertions
        $responseObject->assertSessionHasNoErrors();
        $responseObject->assertOk();
    }
}
