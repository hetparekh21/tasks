<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project as projects;
use App\Models\tasks;

class Project extends Controller
{
    
    public function create(Request $request){

        $project = new projects();
        $project->project_name = $request->project_name;
        $project->save();

        return redirect()->route('home',$project->id);
    }

    public function delete($project_id){

        tasks::where('project_id', $project_id)->delete();

        $project = projects::find($project_id);
        $project->delete();

        return redirect()->route('home');
    }

}
