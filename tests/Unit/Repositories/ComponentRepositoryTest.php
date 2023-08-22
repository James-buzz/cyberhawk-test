<?php

namespace Tests\Unit;

use App\Models\Component;
use App\Models\ComponentType;
use App\Repositories\ComponentRepository;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ComponentRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_get_all_components()
    {
        $models = app(ComponentRepository::class)->getAll();

        $count = Component::count();

        $this->assertEquals($count, $models->count());
    }

    public function test_get_by_id()
    {
        $model = Component::first();

        $repoModel = app(ComponentRepository::class)->getByID($model->id);

        $this->assertEquals($model->id, $repoModel->id);
    }

    public function test_by_invalid_id()
    {
        $this->expectException(ModelNotFoundException::class);

        app(ComponentRepository::class)->getByID(999);
    }

    public function it_can_retrieve_by_component_type_id()
    {
        $model = Component::first();

        $repoModel = app(ComponentRepository::class)->getTypeByID($model->id);

        $this->assertInstanceOf(GradeType::class, $repoModel);
        $this->assertEquals($model->id, $repoModel->id);
    }

     public function it_can_retrieve_a_component_by_id()
     {
         $model = Component::first();

         $repoModel = app(ComponentRepository::class)->getByID($model->id);

         $this->assertInstanceOf(Component::class, $repoModel);
         $this->assertEquals($model->id, $repoModel->id);
     }

     public function it_can_retrieve_types()
     {
         $all_types = ComponentType::all();

         $types = app(ComponentRepository::class)->types();

         $this->assertInstanceOf(Collection::class, $types);
         $this->assertCount(count($all_types), $types);
         foreach ($types as $type) {
             $this->assertDatabaseHas('component_types', $type->toArray());
         }
     }
}
