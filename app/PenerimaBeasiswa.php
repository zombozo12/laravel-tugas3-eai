<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenerimaBeasiswa extends Model
{
    protected $table = 'penerima_beasiswa';
    protected $fillable = ['nim', 'jenis_beasiswa'];
}
