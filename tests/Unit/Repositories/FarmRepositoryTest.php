<?php

namespace Tests\Unit\Repositories;

use App\Models\Farm;
use App\Repositories\FarmRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

/**
 * Tests the FarmRepository class
 */
class FarmRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_get_all()
    {
        $farms = app(FarmRepository::class)->getAll();

        $allFarms = Farm::count();

        $this->assertEquals($allFarms, $farms->count());
    }

    public function test_by_id()
    {
        $farm = Farm::first();

        $retrievedFarm = app(FarmRepository::class)->getByID($farm->id);

        $this->assertEquals($farm->id, $retrievedFarm->id);
    }

    public function test_by_invalid_id()
    {
        $this->expectException(ModelNotFoundException::class);

        app(FarmRepository::class)->getByID(999999);
    }
}
