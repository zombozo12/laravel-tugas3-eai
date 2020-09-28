<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakMahasiswa extends Model
{
    protected $table = 'tak_mhs';

    protected $fillable = ['nim', 'nilai_tak'];
}
