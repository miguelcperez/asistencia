<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    protected $table = 'assists';

    protected $fillable = ['type', 'entry', 'discount_entry', 'exit', 'discount_exit', 'justify', 'personal_id'];

    public function personal()
    {
        $this->belongsTo(Personal::class);
    }
}
