<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class Laporan extends Controller
{
    public function index(Request $req)
    {
		DB::statement("set sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
		$lap = DB::table('tb_pesan')
		->select(DB::raw("tb_pesan.*, sum(tb_pesan_detail.total_harga) as total_harga"))
		->join('tb_pesan_detail','tb_pesan.id_pesan','=','tb_pesan_detail.id_pesan')
		->groupBy('tb_pesan_detail.total_harga')->get();
		$data = [
			"fields"=> [
				[
					"name"=>"nm_pemesan",
					"title"=>"Nama Pemesan"
				],
				[
					"name"=>"kewarganegaraan",
					"title"=>"kewarganegaraan"
				],
				[
					"name"=>"tgl_checkin",
					"title"=>"Cek In"
				],
				[
					"name"=>"tgl_checkout",
					"title"=>"CekOut"
				],
				[
					"name"=>"total_harga",
					"title"=>"Total Bayar"
				]
			],
			"data"=> $lap->toArray()
		];
		$view = view('laporan',$data)->render();
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($view);
		$mpdf->Output();
    }
}
