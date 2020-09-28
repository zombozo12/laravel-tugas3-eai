<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TunggakanBPP extends Model
{
    protected $table = 'tunggakanbpp';

    protected $fillable = ['nim', 'alasan_tunggakan'];
}
