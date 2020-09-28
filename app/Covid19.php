<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid19 extends Model
{
    protected $table = 'covid19';

    protected $fillable = ['nim', 'kondisi', 'zona_tinggal'];
}
