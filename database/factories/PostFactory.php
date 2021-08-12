<?php

namespace Database\Factories;

use App\Models\Category;
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
        $category = Category::all()->random(1)->first();
        return [
            'title' => $this->faker->paragraph(1),
            'content' => $this->faker->paragraph(3),
            'active' => 1,
            'user_id' => $user->id,
            'category_id' => $category->id
        ];
    }
}
