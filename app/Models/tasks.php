<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;

    public $timestamps = true;

    public $primaryKey = 'task_id';

    protected $fillable = [
        'task_name',
        'priority',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\project', 'project_id', 'project_id');
    }
    
}
