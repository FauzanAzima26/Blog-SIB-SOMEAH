<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class categoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }
}
