<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];
    protected $table = 'work'; 
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
