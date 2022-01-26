<?php

namespace App\Model\Process;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'us_certificate';
    protected $primaryKey = 'certificate_id';

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
