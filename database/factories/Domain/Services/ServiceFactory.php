<?php

namespace Database\Factories\Domain\Services;

use Illuminate\Database\Eloquent\Factories\Factory;
use DDD\Domain\Services\Service;
use DDD\Domain\Base\Users\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\DDD\Models\User>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'name' => 'google',
            'token' => ['access_token' => 'fake-token'],
        ];
    }
}
