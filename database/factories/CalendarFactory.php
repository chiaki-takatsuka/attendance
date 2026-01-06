<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calendar>
 */
class CalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isHoliday = $this->faker->boolean(20); // 20%を祝日にする

        return [

            // bool
            'is_holiday' => $isHoliday,

            // 祝日なら名前、違えば null
            'holiday_name' => $isHoliday
                ? $this->faker->randomElement([
                    '元日',
                    '成人の日',
                    '建国記念の日',
                    '春分の日',
                    '昭和の日',
                    '憲法記念日',
                    'みどりの日',
                    'こどもの日',
                ])
                : null,
        ];
    }
}
