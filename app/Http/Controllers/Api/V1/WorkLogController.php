<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\WorkLog;

class WorkLogController extends Controller
{
    public function start($id)
    {
        $response = WorkLog::startWorking($id);
        return($response);
    }
    public function stop($id)
    {
        $response = WorkLog::endWorking($id);
        return($response);
    }
}
