<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre'=> $this->faker->unique()->word(),
            'description'=> $this->faker->sentence(),
            'precio'=> $this->faker->randomFloat(2,8, 100000),
            'stock'=> $this->faker->numberBetween(0, 1000),
            'activo'=> $this->faker->boolean(80),

            
            'marca_id' => Marca::inRandomOrder()->first() ?? Marca::factory(),
        ];
    }
}
