<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model{
    
    public $prefix;
    public $timestamps = false;//关闭自动维护
}