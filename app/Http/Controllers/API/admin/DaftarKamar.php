<?php

namespace App\Http\Controllers\API\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DaftarKamar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $tablePk = 'id_kamar';
    public $table = "tb_daftar_kamar";
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
			"no_kamar"		=> $req->input('no_kamar'),
			"kapasitas"		=> $req->input('kapasitas'),
			"status_kamar"  => $req->input('status_kamar'),
			"id_tkamar"  	=> $req->input('id_tkamar')
		];
		$validate = [
			"no_kamar"		=> "bail|required|max:10",
			"kapasitas"		=> "bail|required|numeric",
			"status_kamar"		=> ["bail","required","regex:/[Kosong|Sedang Dipakai|Perbaikan]/"],
			"id_tkamar"  	=>	"bail|required|numeric"
	    ];
		$validator = \Validator::make($insert, $validate);
		if($validator->fails()){
			$errors = $validator->errors();
			$data->error = [
				"no_kamar"		=> $errors->first('no_kamar'),
				"kapasitas"		=> $errors->first('kapasitas'),
				"status_kamar"  => $errors->first('status_kamar'),
				"id_tkamar"  => $errors->first('id_tkamar')
			];
			$data->status_code = "422";
		}else{
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
}
