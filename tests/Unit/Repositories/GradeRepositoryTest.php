<?php

namespace Tests\Unit\Repositories;

use App\Models\Grade;
use App\Repositories\FarmRepository;
use App\Repositories\GradeRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class GradeRepositoryTest extends TestCase
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
        $grades = app(GradeRepository::class)->getAll();

        $allGrades = Grade::count();

        $this->assertEquals($allGrades, $grades->count());
    }

    public function test_by_id()
    {
        $grade = Grade::first();

        $retrievedGrade = app(FarmRepository::class)->getByID($grade->id);

        $this->assertEquals($grade->id, $retrievedGrade->id);
    }

    public function test_by_invalid_id()
    {
        $this->expectException(ModelNotFoundException::class);

        app(GradeRepository::class)->getByID(9999999);
    }
}
