<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    public function index(Request $req)
    {
		$userLogin = $req->all();
        $hasil = DB::table('tbuser')->where(["username"=>$req->username,"password"=>DB::raw("md5('".$req->password."')")])->get();
        if(count($hasil) == 1){
			$res = true;
		}else $res = false;
		return response()->json(["status"=>$res, "data"=> ["username"=>$hasil[0]->username,"id_juser"=>$hasil[0]->id_juser]]);
    }
}
