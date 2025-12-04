<?php

namespace WPSP\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersModelFactory extends Factory {

	/**
	 * The current password being used by the factory.
	 */
	protected static $password;

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition() {
		return [
			'name'              => fake()->name(),
			'email'             => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password'          => static::$password ??= Hash::make('password'),
			'remember_token'    => Str::random(10),
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified() {
		return $this->state(fn(array $attributes) => [
			'email_verified_at' => null,
		]);
	}

}
