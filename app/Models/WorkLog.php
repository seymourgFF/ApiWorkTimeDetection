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
    public static function startWorking($id_worker)
    {
        $runingTimer = self::all()->where('workers_id', $id_worker)->where('end_time',null)->first();
        if(!empty($runingTimer)){
            //Уже запущен таймер
            return 'Уже запущен таймер';
        }
        if(!Worker::find($id_worker)){
            //Воркера не существует
            return 'Воркера не существует';
        }
        $ldate = new DateTime('now');
        $start = self::firstOrCreate(['workers_id'=>$id_worker, 'start_time'=>$ldate, 'date'=>$ldate]);
        return $start;
    }
    public static function endWorking($id_worker)
    {
        if(!Worker::find($id_worker)){
            //Воркера не существует
            return 'Воркера не существует';
        }
        $ldate = new DateTime('now');
        $end = self::where('workers_id', $id_worker)->where('end_time',null)->first();
        if(empty($end)){
            //Нету таймера который надо остановить
            return 'Нету таймера который надо остановить';
        }
        $end->update(['end_time'=>$ldate]);
        return $end ;
    }
    public static function calculateWorkingHours($id, $start, $end)
    {
        $days = self::all()->where('workers_id',$id)
            ->where('date','>=', $start)
            ->where('date','<=', $end);
        $hours = 0;
        foreach ($days as $day){
            $startThisDay = Carbon::parse($day->start_time);
            $endThisDay = Carbon::parse($day->end_time);
            $hours =$hours + $startThisDay->diffInSeconds($endThisDay);

        }
        $dt = new DateTime();
        $dt->add(new DateInterval('PT' . $hours . 'S'));
        $interval = $dt->diff(new DateTime());

        return $interval->format('%d суток, %h часов, %i минут, %s секунд');
    }

    public static function calculateWorkingHoursAllTime($id)
    {
        $days = self::all()->where('workers_id',$id);
        $hours = 0;
        foreach ($days as $day){
            $startThisDay = Carbon::parse($day->start_time);
            $endThisDay = Carbon::parse($day->end_time);
            $hours =$hours + $startThisDay->diffInSeconds($endThisDay);

        }
        $dt = new DateTime();
        $dt->add(new DateInterval('PT' . $hours . 'S'));
        $interval = $dt->diff(new DateTime());

        return $interval->format('%d суток, %h часов, %i минут, %s секунд');
    }
}
