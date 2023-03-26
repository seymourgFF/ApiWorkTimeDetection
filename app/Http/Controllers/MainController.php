<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Worker;
use App\Models\WorkLog;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MainController extends Controller
{
    public function show($id)
    {
        if(isset($_GET['dates'])){
            $dates = $_GET['dates'];
            $dates_array = explode('-', $dates);
            $from = Carbon::parse($dates_array[0])->format('Y-m-d');
            $to = Carbon::parse($dates_array[1])->format('Y-m-d');
            $hours = WorkLog::calculateWorkingHours($id,$from,$to);
        }else{
            $dates = 'all';
            $from = '';
            $to = '';
            $hours = WorkLog::calculateWorkingHoursAllTime($id);
        }
        $worker = Worker::find($id);
        return view('show', compact('worker','dates','from','to','hours'));
    }


    public function upload()
    {
        return view('upload');
    }
    public function main()
    {
        $workers = Worker::all();
        return view('main', compact('workers'));
    }
    public function store(StoreRequest $request)
    {
        if ($request->isMethod('post') && $request->file('names')) {
            $file = $request->file('names');
            $upload_folder = 'public/folder';
            $filename = $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);
            $file = storage_path('app/public/folder/'). $filename;
            $fh = fopen($file, "r");
            while ($row = fgetcsv($fh)) {
                $name = $row[0];
                Worker::firstOrCreate(['name'=>$name]);
            }
        }
        return redirect()->route('main');
    }
}
