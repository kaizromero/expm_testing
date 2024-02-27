<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];
    protected $table = 'category'; 
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
