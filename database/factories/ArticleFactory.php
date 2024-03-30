<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $imageUrl = "https://picsum.photos/800/600";
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' =>  $this->faker->text(500),
            'image' => $imageUrl,
            'author_id' => User::factory(),
        ];
    }
}
