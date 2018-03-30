<?php

namespace App\Http\Controllers\API\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $tablePk = 'id_user';
    public $table = "tb_user";
    public function index(Request $req)
    {
		$validateQueryString = [
			"per_page"		=> "bail|sometimes|numeric|min:1",
			"page"		=> "bail|sometimes|numeric|min:1",
			"sort"		=> ["bail","sometimes","regex:/[a-zA-Z0-9]{0,20}\|(asc|desc)/"]
		    ];
        $data = new \stdClass;
		$per_page = (int)$req->query('per_page');
		$page = (int)$req->query('page');
		$sort = $req->query('sort');
		
		$validator = \Validator::make($req->query(), $validateQueryString);
		if($validator->fails()){
			$data->error = $validator->errors();
			$data->status_code = "422";
		}else{
			if(isset($sort)) $sort = explode('|',$sort);
			$base_kueri = DB::table($this->table);
			$kueri = $base_kueri->
				when($sort, function ($query) use ($sort) {
							return $query->orderBy($sort[0], substr($sort[1],0,4));
		                });
		    if($per_page || $page){
				$data = $kueri->paginate($per_page ?: 10);
			}else {
				$data->data = $kueri->get();
			}
			$data->status_code = "200";
		}
		return response()->json($data, $data->status_code);
    }

    public function store(Request $req, $id = null) //insert  dan update disatu method
    {
        $data = new \stdclass;
		$insert = [
			"username"		=> $req->input('username'),
			"password"		=> $req->input('password'),
			"status"		=> $req->input('status',1),
			"tipe"			=> $req->input('tipe')
		];
		$validate = [
			"username"		=>	"bail|required|max:10",
			"password"		=>	"bail|required|max:12",
			"status"		=>	"bail|numeric",
			"tipe"			=>	["bail","required","regex:/[Admin|Resepsionis]/"]
	    ];
		$validator = \Validator::make($insert, $validate);
		if($validator->fails()){
			$errors = $validator->errors();
			$data->error = [
				"username"		=> $errors->first('username'),
			    "password"		=> $errors->first('password'),
			    "status"		=> $errors->first('status'),
			    "tipe"			=> $errors->first('tipe')
			];
			$data->status_code = "422";
		}else{
			$insert['password'] = DB::raw('password("'.$req->input('password').'")');
			if($id == null){ // jika id kosong, maka jalankan perintah insert
				$runQuery = DB::table($this->table)->insert($insert);
			}  else { // jika id berisi, maka jalankan perintah update
				$runQuery = DB::table($this->table)->where($this->tablePk, $id)->update($insert);
			}
			if($runQuery) $data->status_code = "200";
			else $data->status_code = "500";
		}
		return response()->json($data, $data->status_code);
    }

    public function show($id)
    {
        $data = [
			"data" => DB::table($this->table)->where($this->tablePk, $id)->get()->first(),
			"status_code" => 200
        ];
        return response()->json($data);
    }
    
    public function destroy($id)
    {
		$status = DB::table($this->table)->where($this->tablePk,$id)->delete();
		return response()->json(['status'=>$status]);
    }
    public function cekLogin(Request $req){
		$hasil = DB::table($this->table)->where([
			"username" => $req->input('username'),
			"password" => DB::raw('password("'.$req->input('password').'")')
		])->get();
		$data = [
			"status"	=> count($hasil) != 0,
			"data"		=> $hasil
		];
		return response()->json($data);
	}
}
