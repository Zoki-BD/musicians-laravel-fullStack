<?php

namespace Database\Factories;

use App\Models\Musician;
use Illuminate\Database\Eloquent\Factories\Factory;

class MusicianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Musician::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
