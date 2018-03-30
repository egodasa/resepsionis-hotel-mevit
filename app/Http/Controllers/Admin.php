<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    public function index(){
		$data = DB::table('statistik')->get()->first();
		$nilai = DB::table('nilai_rata')->orderBy('avg','desc')->get();
		return view('admin.index', ['statistik'=>$data,'nilai'=>$nilai]);
	}
}
