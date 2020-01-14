<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News_cate extends Model
{
    protected $table = 'news_cate';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
}
