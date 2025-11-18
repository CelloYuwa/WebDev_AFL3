<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class BorrowFactory extends Factory
{
    protected $model = Borrow::class;

    public function definition(): array
    {
        $borrowedAt = $this->faker->dateTimeBetween('-2 months', 'now');
        $returnDeadline = (clone $borrowedAt)->modify('+14 days');

        $returnedAt = $this->faker->boolean(70) // 70% chance returned
            ? $this->faker->dateTimeBetween($borrowedAt, $returnDeadline)
            : null;

        $penalty = 0;
        if ($returnedAt && $returnedAt > $returnDeadline) {
            $daysLate = (new Carbon($returnedAt))->diffInDays(new Carbon($returnDeadline));
            $penalty = $daysLate * 500; // example: 500 per day late
        }

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'book_id' => Book::inRandomOrder()->first()->id,
            'borrowed_at' => $borrowedAt,
            'return_deadline' => $returnDeadline,
            'returned_at' => $returnedAt,
            'penalty' => $penalty,
        ];
    }
}
