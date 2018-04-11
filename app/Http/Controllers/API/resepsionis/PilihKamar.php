<?php

namespace App\Http\Controllers\API\resepsionis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PilihKamar extends Controller
{
    public function index(Request $req, $id)
    {
		$selected_kamar = $req->query('selected_kamar');
		$kueri = DB::table('tb_daftar_kamar')->where(array('id_tkamar' => $id,'status_kamar'=>"Kosong"))
				->when($selected_kamar, function ($query) use ($selected_kamar) {
					return $query->whereNotIn('id_kamar',explode(',',$selected_kamar));
                });
		$kamar = $kueri->get()->first();
        return response()->json(array("data"=>$kamar));
        return response()->json(array("data"=>$kamar));
    }
}
