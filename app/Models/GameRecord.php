<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRecord extends Model
{
    protected $table = 'games_record';

    protected $guarded = [];
    
    
    public function getMember() {
        return $this->belongsTo('App\Models\Member');
    }

    public function member(){
        return $this->hasOne('App\\Models\\Member', 'id', 'member_id')->withTrashed();
    }
}
