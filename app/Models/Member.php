<?php namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
class Member extends Authenticatable{
    
    protected $table = 'member';
    
    protected $guarded = [];
    
    
//     public function getAuthPassword()
//     {
//         return $this->attributes['password'];
//     }
}