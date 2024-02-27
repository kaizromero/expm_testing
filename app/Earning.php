<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $guarded = [];
    protected $table = 'earnings'; 
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
