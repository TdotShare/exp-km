<?php

namespace App\Model\Process;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'us_project';
    protected $primaryKey = 'project_id';

    //public $incrementing = false;
    // protected $fillable = [
    //     'name'
    // ];

    // protected $hidden = [
    //     'pass_member',
    // ];

    protected $keyType = 'int';
    public $timestamps = false;
    
}
