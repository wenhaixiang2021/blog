<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $table = 'number_people';
    protected $primaryKey = 'number_id';
    public $timestamps = false;
    public $guarded=[];//黑名单   create()方法才用到
}