<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // database/factories/TaskFactory.php

    public function definition(): array
    {
        return [
            // 'title' には、偽の「文章」を入れる
            'title' => fake()->sentence(),

            // 'description' には、偽の「段落」を入れる
            'description' => fake()->paragraph(),

            // 'long_description' には、偽の「7文の段落」を入れる
            'long_description' => fake()->paragraph(7),

            // 'completed' には、ランダムな true/false (boolean) を入れる
            'completed' => fake()->boolean(),
        ];
    }
}
