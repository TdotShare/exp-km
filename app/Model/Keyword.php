<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'misrd_keyword';
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
