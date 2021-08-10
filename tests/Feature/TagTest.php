<?php

namespace Tests\Feature;

use App\Models\Tag;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tag_guess_cant_access()
    {
        $response = $this->get(route('admin.tags.index'));

        $response->assertStatus(302);
    }

    public function test_tag_admin_access(){
        $this->actingAsAdmin();
        
        $this->seed(TagSeeder::class);

        $response = $this->get(route('admin.tags.index'));
        $response->assertOk();
    }

    public function test_post_create_view(){
        $this->actingAsAdmin();

        $response = $this->get(route('admin.tags.create'));
        $response->assertOk();
    }

    public function test_tag_store(){
        $this->actingAsAdmin();

        $tag_data = Tag::factory(1)->raw()[0];

        $response = $this->post(route('admin.tags.store'),$tag_data);
        $this->assertDatabaseHas('tags',$tag_data);
        $response->assertRedirect(route('admin.tags.create'));
    }

    public function test_tag_edit(){
        $this->actingAsAdmin();

        $tag = Tag::factory(1)->create()->first();
        $response = $this->get(route('admin.tags.edit',$tag->id));
        $response->assertOk();
    }

    public function test_tag_update(){
        $this->actingAsAdmin();
        $tag = Tag::factory(1)->create()->first();

        $tag_data_update = Tag::factory(1)->raw()[0];

        $response = $this->put(route('admin.tags.update',$tag->id),$tag_data_update);
        $this->assertDatabaseHas('tags',$tag_data_update);

        $response->assertRedirect(route('admin.tags.edit',$tag->id));
    }
}
