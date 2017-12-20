<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LogMemberMoney extends Model
{
    protected $table = 'log_member_money';
//     protected $fillable = [];
    protected $guarded = [];

    
    public function member(){
        return $this->hasOne('App\\Models\\Member', 'id', 'member_id')->withTrashed();
    }

}