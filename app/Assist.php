<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    protected $table = 'assists';

    protected $fillable = ['type', 'entry', 'exit', 'discount', 'personal_id'];

    public function personal()
    {
        $this->belongsTo(Personal::class);
    }
}
