<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Database\Seeders\PostSeeder;
use Database\Seeders\PostTagSeeder;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_guess_cant_access()
    {
        $response = $this->get(route('admin.posts.index'));

        $response->assertStatus(302);
    }

    public function test_post_admin_access(){
        $this->actingAsAdmin();
        
        $this->seed(PostSeeder::class);

        $response = $this->get(route('admin.posts.index'));
        $response->assertOk();
    }

    public function test_post_view(){
        $this->actingAsAdmin();

        $post = Post::factory(1)->create()->first();

        $response = $this->get(route('admin.posts.show',$post->id));
        $response->assertOk();
    }

    public function test_post_create_view(){
        $this->actingAsAdmin();

        $response = $this->get(route('admin.posts.create'));
        $response->assertOk();
    }

    public function test_post_store(){
        $this->actingAsAdmin();

        // creación de tags
        $this->seed(TagSeeder::class);
        $tags = Tag::all()->random(3);
        $tags = $tags->pluck('id')->toArray();

        $post_data = Post::factory(1)->raw()[0];
        $post_data['tags'] = $tags;

        $response = $this->post(route('admin.posts.store'),$post_data);
        $post = Post::all()->first();

        // se elimina tags de data para comparar si el registro de data existe en post.
        unset($post_data['tags']);
        $this->assertDatabaseHas('posts',$post_data);

        // Se extrae los tags del post
        $post_tags = $post->tags->all();
        $this->assertCount(count($tags),$post_tags);
        
        $response->assertRedirect(route('admin.posts.create'));
    }

    public function test_post_edit(){
        $this->actingAsAdmin();

        $post = Post::factory(1)->create()->first();
        $response = $this->get(route('admin.posts.edit',$post->id));
        $response->assertOk();
    }

    public function test_post_update(){
        $this->actingAsAdmin();

        $this->seed(TagSeeder::class);
        $post = Post::factory(1)->create()->first();
        $this->seed(PostTagSeeder::class);

        $tags = Tag::all()->random(2);
        $tags = $tags->pluck('id')->toArray();
        $post_data_update = Post::factory(1)->raw()[0];
        $post_data_update['tags'] = $tags;
        $post_data_update['id'] = $post->id;

        $response = $this->put(route('admin.posts.update',['post' => $post_data_update['id']]),$post_data_update);

        unset($post_data_update['tags']);
        $this->assertDatabaseHas('posts',$post_data_update);

        $response->assertRedirect(route('admin.posts.edit',$post->id));
    }

}
