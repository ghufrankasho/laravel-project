<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' =>  $this->faker->text,
            'description' =>  $this->faker->text,
            'cat_id' =>  $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
            'child_cat_id' =>  $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('213', '213'),
            'price' => $this->faker->numberBetween(100, 1000),
            'offer_price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(10, 100),
            'size' => $this->faker->randomElement(['S','M','L']),
            'status' => $this->faker->randomElement(['active','inactive']),
            'conditions' => $this->faker->randomElement(['new','popular','winter']),
        ];
    }
}
