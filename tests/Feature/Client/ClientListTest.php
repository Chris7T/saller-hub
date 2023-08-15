<?php

namespace Tests\Feature\Client;

use App\Actions\Client\ClientListAction;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Mockery;
use Tests\TestCase;

class ClientListTest extends TestCase
{
    private const ROUTE = 'client.list';

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user, 'web');
    }

    public function test_expected_true_when_route_exists()
    {
        $this->assertTrue(Route::has(self::ROUTE));
    }

    public function test_expected_unprocessable_entity_exception_when_name_is_invalid()
    {
        $response = $this->getJson(route(self::ROUTE, ['name' => ' ']));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_expected_server_error_when_action_throw_exception()
    {
        $name = 'SomeClientName';

        $clientListActionMock = Mockery::mock(ClientListAction::class);
        $clientListActionMock->shouldReceive('execute')
            ->with($name)
            ->andThrow(new \Exception('Some error occurred'));
        $this->app->instance(ClientListAction::class, $clientListActionMock);

        $response = $this->getJson(route(self::ROUTE, ['name' => $name]));

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->assertJson([
                'message' => config('messages.error.server'),
            ]);
    }

    public function test_expected_token_when_action_is_successful()
    {
        $name = 'SomeClientName';

        $response = $this->getJson(route(self::ROUTE, ['name' => $name]));

        $response->assertStatus(Response::HTTP_OK);
    }
}
