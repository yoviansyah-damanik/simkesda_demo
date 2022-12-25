<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $body = collect($this->faker->paragraphs(mt_rand(5, 10)))
            ->map(fn ($p) => "<p>$p</p>")
            ->implode('');

        $excerpt = Str::limit(strip_tags($body), 200);
        return [
            'title' => $this->faker->sentence(mt_rand(8, 12)),
            'slug' => $this->faker->slug(),
            'excerpt' => $excerpt,
            'body' => $body,
            'user_id' => mt_rand(1, 3),
            'published_at' => $this->faker->dateTimeBetween($startDate = '-10 days', $endDate = 'now'),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now')
        ];
    }
}
