<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Calendar;
use Carbon\Carbon;

class CalendarSeeder extends Seeder
{
    public function run()
    {
        DB::table('calendars')->truncate();

        $start = Carbon::create(2025, 12, 1);
        $end   = Carbon::create(2026, 12, 31);

        for ($date = $start; $date->lte($end); $date->addDay()) {
            Calendar::factory()->create([
                'calendar_date' => $date->toDateString(),
            ]);
        }
    }
}
