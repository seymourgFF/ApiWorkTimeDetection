<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Worker;
use App\Models\WorkLog;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PageController extends Controller
{
    public function showWorker(DateRequest $request, int $id)
    {
        Carbon::setLocale('ru');
        $data = $request->validated();
        if (isset($data['dates'])) {
            $dates = $data['dates'];
            $dates_array = explode('-', $dates);
            $from = Carbon::parse($dates_array[0])->format('Y-m-d');
            $to = Carbon::parse($dates_array[1])->format('Y-m-d');
            $hours = WorkLog::calculateWorkingHours($id, $from, $to);
        } else {
            $dates = 'all';
            $from = '';
            $to = '';
            $hours = WorkLog::calculateWorkingHoursAllTime($id);
        }
        $from = Carbon::parse($from)->translatedFormat('d F');
        $to = Carbon::parse($to)->translatedFormat('d F');
        $worker = Worker::find($id);
        return view('show', compact('worker', 'dates', 'from', 'to', 'hours'));
    }


    public function uploadWorker()
    {
        return view('upload');
    }

    public function indexWorker()
    {
        $workers = Worker::all();
        return view('main', compact('workers'));
    }

    public function storeWorker(StoreRequest $request)
    {
        if ($request->isMethod('post') && $request->file('names')) {
            $file = $request->file('names');
            $upload_folder = 'public/folder';
            $filename = $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);
            $file = storage_path('app/public/folder/') . $filename;
            $fh = fopen($file, "r");
            while ($row = fgetcsv($fh)) {
                $name = $row[0];
                Worker::firstOrCreate(['name' => $name]);
            }
        }
        return redirect()->route('main');
    }

    public function timer()
    {
        $workers = Worker::all();
        return view('timer', compact('workers'));
    }
}
