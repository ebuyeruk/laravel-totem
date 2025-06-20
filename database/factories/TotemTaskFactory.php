<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ebuyer\Totem\Task;

class TotemTaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        dump('Factory Faker Instance:', get_class($this->faker));
        dump('Factory Faker Providers:', array_map(fn($provider) => get_class($provider), $this->faker->getProviders()));

        return [
            'description' => $this->faker->sentence,
            'command' => 'Ebuyer\Totem\Console\Commands\ListSchedule',
            'expression' => '* * * * *',
        ];
    }
}
