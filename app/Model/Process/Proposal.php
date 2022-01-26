<?php

namespace App\Model\Process;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'concept_proposal';
    protected $primaryKey = 'concept_proposal_id';

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
