<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dosen extends Controller
{
    public function index(){
		$data = DB::table('statistik')->get()->first();
		$nilai = DB::table('nilai_rata')->orderBy('avg','desc')->get();
		return view('dosen.index', ['statistik'=>$data,'nilai'=>$nilai]);
	}
}
