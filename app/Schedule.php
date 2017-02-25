<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	public $table = "schedule";
    protected $fillable = [
        'day', 'init_hour', 'end_hour',
    ];
    public function personal() 
    {
    	return $this->belongsToMany('App\Personal');
    }
}
