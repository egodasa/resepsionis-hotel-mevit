<?php

namespace App\Http\Controllers\API\resepsionis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Transaksi extends Controller
{
	public $tablePk = 'id_pesan';
    public $table = "tb_pesan";
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
    public function tambahTransaksi(Request $req)
    {
        $transaksi = array(
			"id_pesan"       => $req->input("id_pesan"),
			"tgl_checkin"    => $req->input("tgl_checkin"),
			"tgl_checkout"	 => $req->input("tgl_checkout"),
			"no_identitas"   =>	$req->input("no_identitas"),
			"nm_pemesan"     => $req->input("nm_pemesan"),
			"kontak"         => $req->input("kontak"),
			"kewarganegaraan"=> $req->input("kewarganegaraan")
        );
        $detail = $req->input('detail');
        DB::table('tb_pesan')->insert($transaksi);
        DB::table('tb_pesan_detail')->insert($detail);
		return response()->json(array("status"=>true));
    }
    public function detailTransaksi($id){
		$detail = DB::table('tb_pesan_detail')->where('id_pesan',$id)
			->join('daftar_kamar','tb_pesan_detail.id_kamar','=','daftar_kamar.id_kamar')
			->get();
		return response()->json(array("data" => $detail));
	}
}
