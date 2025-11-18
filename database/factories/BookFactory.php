<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $total = $this->faker->numberBetween(5, 20);

        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Science', 'Fiction', 'Biography', 'History', 'Fantasy']),
            'year' => $this->faker->year(),
            'isbn' => $this->faker->isbn13(),
            'description' => $this->faker->paragraph(),
            'cover_url' => 'https://picsum.photos/300/400?random=' . $this->faker->numberBetween(1, 100),
            'total_copy' => $total,
            'available_copy' => $total,
            'borrowed_copy' => 0,
        ];
    }
}
