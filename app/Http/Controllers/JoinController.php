<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    
    public function join(Request $request) {
        if($request->has('search')){
            $datas = DB::select('SELECT pembeli.id_pembeli, pembeli.nama_pembeli, barang.nama_barang, barang.harga_barang, penjual.nama_penjual, ekspedisi.nama_ekspedisi, ekspedisi.biaya_ekspedisi FROM `pembeli` LEFT JOIN ekspedisi ON ekspedisi.id_ekspedisi = pembeli.id_ekspedisi LEFT JOIN barang on barang.id_barang = pembeli.id_barang LEFT JOIN penjual on penjual.id_barang = pembeli.id_barang WHERE pembeli.nama_pembeli like :search',[
                'search'=>'%'.$request->search.'%',
            ]);

        return view('join')
            ->with('datas', $datas);
        }
        else {
            $datas = DB::select('SELECT pembeli.id_pembeli, pembeli.nama_pembeli, barang.nama_barang, barang.harga_barang, penjual.nama_penjual, ekspedisi.nama_ekspedisi, ekspedisi.biaya_ekspedisi FROM `pembeli` LEFT JOIN ekspedisi ON ekspedisi.id_ekspedisi = pembeli.id_ekspedisi LEFT JOIN barang on barang.id_barang = pembeli.id_barang LEFT JOIN penjual on penjual.id_barang = pembeli.id_barang ORDER BY pembeli.id_pembeli');

        return view('join')
            ->with('datas', $datas);
        }
    }
}