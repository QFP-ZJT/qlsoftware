<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobs extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'id' , 'queue' ,'attempts','reserved','created_at'
    ];
}
