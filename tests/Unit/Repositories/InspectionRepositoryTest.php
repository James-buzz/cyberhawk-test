<?php

namespace Tests\Unit\Repositories;

use App\Models\Inspection;
use App\Repositories\InspectionRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class InspectionRepositoryTest extends TestCase
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
        $inspections = app(InspectionRepository::class)->getAll();

        $allInspections = Inspection::count();

        $this->assertEquals($allInspections, $inspections->count());
    }

    public function test_by_id()
    {
        $inspection = Inspection::first();

        $retrievedInspection = app(InspectionRepository::class)->getByID($inspection->id);

        $this->assertEquals($inspection->id, $retrievedInspection->id);
    }

    public function test_by_invalid_id()
    {
        $this->expectException(ModelNotFoundException::class);

        app(InspectionRepository::class)->getByID(999999);
    }
}
