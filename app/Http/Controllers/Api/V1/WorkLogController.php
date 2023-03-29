<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\WorkLog;
use Carbon\Carbon;
use DateInterval;
use DateTime;

class WorkLogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/work/start/{id}",
     *     operationId="startWorkApi",
     *     tags={"Workers"},
     *     summary="Start worker timer api ",
     *     security={
     *          {"bearerAuth":{}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id",
     *         @OA\Schema(
     *              type="string"
     *         )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Timer start"
     *     ),
     *      @OA\Response(
     *          response="400",
     *          description="Worker not found"
     *     )
     * )
     * Start worker timer api
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function start(int $id)
    {
        $runingTimer = WorkLog::all()->where('workers_id', $id)->where('end_time', null)->first();
        if (!empty($runingTimer)) {
            return response('Уже запущен таймер', 400);

        }
        if (!Worker::find($id)) {
            return response('Воркера не существует', 400);
        }
        $ldate = new DateTime('now');
        $start = WorkLog::firstOrCreate(['workers_id' => $id, 'start_time' => $ldate, 'date' => $ldate]);
        return response($start, 200);
    }


    /**
     * @OA\Get(
     *     path="/api/work/stop/{id}",
     *     operationId="stopWorkApi",
     *     tags={"Workers"},
     *     summary="Stop worker timer api ",
     *     security={
     *          {"bearerAuth":{}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id",
     *         @OA\Schema(
     *              type="string"
     *         )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Timer stop"
     *     ),
     *      @OA\Response(
     *          response="400",
     *          description="nothing to stop"
     *     )
     * )
     * Stop worker timer api
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function stop(int $id)
    {
        if (!Worker::find($id)) {
            return response('Воркера не существует', 400);
        }
        $ldate = new DateTime('now');
        $end = WorkLog::where('workers_id', $id)->where('end_time', null)->first();
        if (empty($end)) {
            return response('Нету таймера который надо остановить', 400);
        }
        $end->update(['end_time' => $ldate]);
        return response($end, 200);
    }
}
