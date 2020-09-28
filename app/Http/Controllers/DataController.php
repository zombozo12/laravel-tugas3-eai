<?php

namespace App\Http\Controllers;

use App\Covid19;
use App\PenerimaBeasiswa;
use App\TunggakanBPP;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function dashboard(){
        $covid = Covid19::all();
        $tunggakan = TunggakanBPP::all();
        $beasiswa = PenerimaBeasiswa::all();

        return view('dashboard')
            ->with('data_covid', $covid)
            ->with('data_tunggakan', $tunggakan)
            ->with('data_beasiswa', $beasiswa);
    }
}
