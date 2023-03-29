<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    use HasFactory;

    protected $table = 'work_logs';
    protected $guarded = false;

    public static function calculateWorkingHours(int $id, string $start, string $end)
    {
        $days = self::all()->where('workers_id', $id)
            ->where('date', '>=', $start)
            ->where('date', '<=', $end);
        $hours = 0;
        foreach ($days as $day) {
            $startThisDay = Carbon::parse($day->start_time);
            $endThisDay = Carbon::parse($day->end_time);
            $hours = $hours + $startThisDay->diffInSeconds($endThisDay);

        }
        $dt = new DateTime();
        $dt->add(new DateInterval('PT' . $hours . 'S'));
        $interval = $dt->diff(new DateTime());
        $days = $interval->d * 24;
        $hours = $interval->h + $days;
        $min = $interval->i;
        return $hours .' Часов и ' . $min .' Минут.';
    }

    public static function calculateWorkingHoursAllTime(int $id)
    {
        $days = self::all()->where('workers_id', $id);
        $hours = 0;
        foreach ($days as $day) {
            $startThisDay = Carbon::parse($day->start_time);
            $endThisDay = Carbon::parse($day->end_time);
            $hours = $hours + $startThisDay->diffInSeconds($endThisDay);

        }
        $dt = new DateTime();
        $dt->add(new DateInterval('PT' . $hours . 'S'));
        $interval = $dt->diff(new DateTime());
        $days = $interval->d * 24;
        $hours = $interval->h + $days;
        $min = $interval->i;
        return $hours .' Часов и ' . $min .' Минут.';
    }
}
