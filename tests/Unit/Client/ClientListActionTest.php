<?php

namespace Tests\Unit\Actions;

use App\Actions\Client\ClientListAction;
use App\Repositories\Client\ClientInterfaceRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Tests\TestCase;

class ClientListActionTest extends TestCase
{
    private $mockRepository;
    private $collection;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockRepository = Mockery::mock(ClientInterfaceRepository::class);
        $this->collection = new Collection();
    }

    public function test_execute_with_null_clientName_and_no_cache()
    {
        $this->mockRepository->shouldReceive('list')->with(null)->andReturn(new Collection(['data']));

        $action = new ClientListAction($this->mockRepository);

        $result = $action->execute();

        $this->assertEquals(new Collection(['data']), $result);
    }

    public function test_execute_with_null_clientName_and_existing_cache()
    {
        Cache::shouldReceive('remember')
            ->andReturn($this->collection);
        $action = new ClientListAction($this->mockRepository);

        $result = $action->execute();

        $this->assertEquals(new Collection(), $result);
    }

    public function test_execute_with_clientName_and_existing_cache()
    {
        $clientName = "John";

        Cache::shouldReceive('remember')
            ->andReturn($this->collection);

        $this->mockRepository = Mockery::mock(ClientInterfaceRepository::class);

        $action = new ClientListAction($this->mockRepository);

        $result = $action->execute($clientName);

        $this->assertEquals(new Collection(), $result);
    }

    public function test_execute_with_clientName_and_no_cache()
    {
        $clientName = "John";

        $this->mockRepository->shouldReceive('list')->with($clientName)->andReturn(new Collection(['johnData']));

        $action = new ClientListAction($this->mockRepository);

        $result = $action->execute($clientName);

        $this->assertEquals(new Collection(['johnData']), $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
