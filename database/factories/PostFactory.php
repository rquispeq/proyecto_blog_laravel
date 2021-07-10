<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->first();
        return [
            'title' => $this->faker->paragraph(1),
            'content' => $this->faker->paragraph(3),
            'img_post' => $this->faker->imageUrl(640,480,'animals',true),
            'active' => 1,
            'user_id' => $user->id
        ];
    }
}
