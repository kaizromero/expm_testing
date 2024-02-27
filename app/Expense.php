<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $guarded = [];
    protected $table = 'expenses'; 
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
