<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_category_guess_cant_access()
    {
        $response = $this->get(route('admin.tags.index'));

        $response->assertStatus(302);
    }

    public function test_category_admin_access(){
        $this->actingAsAdmin();
        $this->seed(CategorySeeder::class);

        $response = $this->get(route('admin.categories.index'));
        $response->assertOk();
    }

    public function test_category_create_view(){
        $this->actingAsAdmin();

        $response = $this->get(route('admin.categories.create'));

        $response->assertOk();
    }

    public function test_category_store(){
        $this->actingAsAdmin();

        $category_data = Category::factory(1)->raw()[0];

        $response = $this->post(route('admin.categories.store'),$category_data);

        $this->assertDatabaseHas('categories',$category_data);
        $response->assertRedirect(route('admin.categories.create'));

    }

    public function test_category_edit_view(){
        $this->actingAsAdmin();

        $category = Category::factory(1)->create()->first();

        $response = $this->get(route('admin.categories.edit',$category->id));

        $response->assertOk();
    }

    public function test_category_update(){
        $this->actingAsAdmin();

        $category_data_update = Category::factory(1)->raw()[0];

        $category = Category::factory(1)->create()->first();

        $response = $this->put(route('admin.categories.update',$category->id),$category_data_update);

        $this->assertDatabaseHas('categories',$category_data_update);
        $response->assertRedirect(route('admin.categories.edit',$category->id));
    }
}
