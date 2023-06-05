<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'project';
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_name'
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\task', 'project_id', 'project_id');
    }

}
