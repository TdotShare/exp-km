<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bantexts extends Model
{
    protected $table = 'bantexts';
    protected $primaryKey = 'bantexts_id';

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
