<?php

namespace App\Http\Controllers\API\dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Ujian extends Controller
{
    public $tablePk = 'id_ujian';
    public $tableView = "lap_ujian";
    public $table = "tbujian";
    public function index(Request $req, $nidn)
    {
		$validateQueryString = [
			"per_page"		=> "bail|sometimes|numeric|min:1",
			"page"		=> "bail|sometimes|numeric|min:1",
			"sort"		=> ["bail","sometimes","regex:/[a-zA-Z0-9]{0,20}\|(asc|desc)/"]
	    ];
        $data = new \stdClass; //penampung record dari db
		$per_page = $req->query('per_page');
		$page = $req->query('page');
		$sort = $req->query('sort');
		
		$validator = \Validator::make($req->query(), $validateQueryString);
		if($validator->fails()){
			$data->error = $validator->errors();
			$data->status_code = "422";
		}else{
			if(isset($sort)) $sort = explode('|',$sort);
		
			$base_kueri = DB::table($this->tableView)->where('nidn', $nidn);
			$totalData = DB::table($this->tableView)->select(DB::raw('COUNT(1) as total'))->where('nidn', $nidn)->get()->first();
			
			if(isset($per_page) && !isset($page)) $page = 1;
			else if(!isset($per_page) && isset($page)) $per_page = 10;
			
			$kueri = $base_kueri->
				when($sort, function ($query) use ($sort) {
							return $query->orderBy($sort[0], substr($sort[1],0,4));
		                })->
				when($per_page, function ($query) use ($per_page) {
							$page = 1;
							return $query->limit($per_page)->offset(0);
		                })->
				when($page, function ($query) use ($page) {
							$per_page = 10;
							return $query->limit(10)->offset((int)(10 * ($page-1)));
		                });
		                
			$data->data = $kueri->get();
			
			if(isset($per_page) || isset($page)){ // Jika di url ada per_page atau page, maka buat respon paginasi
				$lastPage = ceil($totalData->total/(int)$per_page);
			
				$queryStringNext = [
					"per_page"		=> $per_page,
					"page"			=> $page+1 <= 1 ? null : $page+1,
					"sort"			=> $sort
				];
				$queryStringPrev = [
					"per_page"		=> $per_page,
					"page"			=> $page-1 > $lastPage ? null : $page-1,
					"sort"			=> $sort
				];
				
				$data->pagination = [
					"per_page"		=> (int)$per_page,
					"current_page"	=> (int)$page,
					"from"			=> (($page-1)*$per_page)+1,
					"to"			=> ($page*$per_page),
					"last_page"		=> $lastPage,
					"next_page_url" => $queryStringNext['page'] == null ? null : strtok($_SERVER["REQUEST_URI"],'?').'?'.http_build_query($queryStringNext),
					"prev_page_url" => $queryStringPrev['page'] == null ? null : strtok($_SERVER["REQUEST_URI"],'?').'?'.http_build_query($queryStringPrev)
				];
			}
			$data->pagination['total'] = $totalData->total;
			$data->status_code = "200";
		}
		return response()->json($data, $data->status_code);
    }

    public function store(Request $req, $id = null) //insert  dan update disatu method
    {
        $data = new \stdclass;
		$insert = [
			"hari"			=> $req->input('hari'),
			"mulai"			=> $req->input('mulai'),
			"selesai"		=> $req->input('selesai'),
			"deskripsi"		=> $req->input('deskripsi'),
			"id_jujian"		=> $req->input('id_jujian'),
			"id_jsoal"		=> $req->input('id_jsoal'),
			"id_kuliah"		=> $req->input('id_kuliah'),
			"id_ujian"		=> $req->input('id_kuliah')."-".$req->input('id_jujian')
		];
		$validate = [
			"hari"				=> "bail|required|date",
			"mulai"			=> "bail|required|max:10",
			"selesai"	=> "bail|required|max:10",
			"deskripsi"		=> "bail|required|max:100",
			"id_jujian"		=> "bail|required|numeric",
			"id_jsoal"		=> "bail|required|numeric",
			"id_kuliah"		=> "bail|required|numeric"
	    ];
		$validator = \Validator::make($insert, $validate);
		if($validator->fails()){
			$errors = $validator->errors();
			$data->error = [
				"nm_jsoal"	=> $errors->first('nm_jsoal')
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
