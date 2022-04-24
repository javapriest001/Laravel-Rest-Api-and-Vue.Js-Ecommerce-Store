<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{

    protected $product = product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       $name = $this->faker->text(20);
        $price = 100;
       
        return [
            //
            'name' => $name,
            'desc' => $this->faker->text(120),
            'slug' =>  Str::slug($name) ,
            'price' => $price,
            'sale_price' => $price - 5,
            'product_img' => $this->faker->imageUrl( $width = 640,
            $height = 480),
            'category_id' => 1,
        ];

       
    }
}
