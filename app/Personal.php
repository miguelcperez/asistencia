<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
	public $table = "personal";
    protected $fillable = [
        'code', 'name',
    ];
    public function schedules() 
    {
    	return $this->belongsToMany('App\Schedule');
    }
}
