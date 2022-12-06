<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from pembeli WHERE nama_pembeli like :search',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        return view('pembeli.index')
            ->with('datas', $datas);
        }
        else{
            $datas = DB::select('select * from pembeli');
        
        return view('pembeli.index')
            ->with('datas', $datas);
        }
    }

    public function create() {
        return view('pembeli.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'alamat_pembeli' => 'required',
            'id_barang' => 'required',
            'id_ekspedisi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pembeli(id_pembeli, nama_pembeli, alamat_pembeli, id_barang, id_ekspedisi) VALUES (:id_pembeli, :nama_pembeli, :alamat_pembeli, :id_barang, :id_ekspedisi)',
        [
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'id_barang' => $request->id_barang,
            'id_ekspedisi' => $request->id_ekspedisi,

        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('pembeli')->where('id_pembeli', $id)->first();

        return view('pembeli.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_pembeli' => 'required',
            'nama_pembeli' => 'required',
            'alamat_pembeli' => 'required',
            'id_barang' => 'required',
            'id_ekspedisi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE pembeli SET id_pembeli = :id_pembeli, nama_pembeli = :nama_pembeli, alamat_pembeli = :alamat_pembeli, id_barang = id_barang, id_ekspedisi = id_ekspedisi WHERE id_pembeli = :id',
        [
            'id' => $id,
            'id_pembeli' => $request->id_pembeli,
            'nama_pembeli' => $request->nama_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'id_barang' => $request->id_barang,
            'id_ekspedisi' => $request->id_ekspedisi,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat_pembeli' => $request->alamat_pembeli,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM pembeli WHERE id_pembeli = :id_pembeli', ['id_pembeli' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_pembeli', $id)->delete();

        return redirect()->route('pembeli.index')->with('success', 'Data Admin berhasil dihapus');
    }


}
