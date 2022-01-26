<?php

namespace App\Model\Process;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'us_award';
    protected $primaryKey = 'award_id';

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
