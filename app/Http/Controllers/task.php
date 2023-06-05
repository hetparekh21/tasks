<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasks;
use App\Models\project as project;

use Illuminate\Support\Facades\DB;

class task extends Controller
{
    public static $projects;

    public function __construct()
    {

        self::$projects = project::all();

    }

    public function index($project = null)
    {

        $projects = self::$projects;

        if ($project != null) {

            $tasks = tasks::where('project_id', $project)->orderBy('priority')->get();

            return view('index', compact('tasks', 'projects', 'project'));

        } else {

            return view('index', compact('projects'));

        }

    }

    public function create(Request $request)
    {

        $task = new tasks();
        $task->task_name = $request->task_name;
        $task->project_id = $request->project_id;
        $task->priority = tasks::where('project_id', $request->project_id)->max('priority') + 1;
        $task->save();

        return redirect()->back();

    }

    public function delete($task_id)
    {

        $task = tasks::find($task_id);
        $task->delete();
        $update_priority = tasks::where('project_id', $task->project_id)->where('priority', '>', $task->priority)->update(['priority' => DB::raw('priority - 1')]);

        return redirect()->back();

    }

    public function update(Request $request)
    {

        $task = tasks::find($request->task_id);
        $task->task_name = $request->task_name;
        $task->save();

        return redirect()->back();

    }
    public function update_priority(Request $request)
    {

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
    }

}