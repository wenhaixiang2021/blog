<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';
    protected $primaryKey = 'house_id';
    public $timestamps = false;
}
