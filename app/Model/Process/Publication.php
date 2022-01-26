<?php

namespace App\Model\Process;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'us_publication';
    protected $primaryKey = 'publication_id';

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
