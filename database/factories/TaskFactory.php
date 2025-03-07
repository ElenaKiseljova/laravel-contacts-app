<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => fake()->sentence(),
      'description' => fake()->text()
    ];
  }

  public function completed()
  {
    return $this->state(function () {
      return [
        'status' => true
      ];
    });
  }

  public function uncompleted()
  {
    return $this->state(function () {
      return [
        'status' => false
      ];
    });
  }

  public function tomorrow()
  {
    return $this->state(function () {
      return [
        'due_date' => now()->addDay()
      ];
    });
  }

  public function priority($level = 1)
  {
    // return $this->state(function () use($level) {
    //   return [
    //     'due_date' => $level
    //   ];
    // });

    return $this->state(fn () => [
      'due_date' => $level
    ]);
  }
}
