<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expworkres extends Model
{
    protected $table = 'expwork_res';
    protected $primaryKey = 'id';

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
