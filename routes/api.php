<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\tasks;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/task', function (Request $req) {

    $task_id = $req->task_id;
    $task = tasks::find($task_id);
    return json_encode($task);

})->name('task_detail')->whereNumber('task_id');

Route::post('/update_priority', function (Request $request) {
    $task_id = $request->task_id;
    $task = tasks::find($task_id);

    $project_id = $task->project_id;
    $priority = $task->priority;

    $to = $request->to;
    $from = $request->from;

    // echo $from . "__" . $to;die;

    if ($to > $from) {

        $update_priority = tasks::where('project_id', $project_id)->where('task_id', '!=', $task_id)->where('priority', '<=', $to)->where('priority', '>', $from)->update(['priority' => DB::raw('priority - 1')]);

    } else {

        $update_priority = tasks::where('project_id', $project_id)->where('task_id', '!=', $task_id)->where('priority', '>=', $to)->where('priority', '<', $from)->update(['priority' => DB::raw('priority + 1')]);

    }

    if (!$update_priority) {

        return json_encode(array('msg' => 'error'));

    } else {

        $task->priority = $to;
        $task->save();

    }

    return json_encode(array('msg' => 'success'));
})->name('update_priority');