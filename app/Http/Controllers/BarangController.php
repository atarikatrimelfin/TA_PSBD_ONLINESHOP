<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from barang WHERE nama_barang like :search',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        return view('barang.index')
            ->with('datas', $datas);
        }
        else{
            $datas = DB::select('select * from barang');
        
        return view('barang.index')
            ->with('datas', $datas);
        }
    }

    public function create() {
        return view('barang.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO barang(id_barang, nama_barang, harga_barang, jumlah_barang) VALUES (:id_barang, :nama_barang, :harga_barang, :jumlah_barang)',
        [
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
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

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('barang')->where('id_barang', $id)->first();

        return view('barang.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE barang SET id_barang = :id_barang, nama_barang = :nama_barang, harga_barang = :harga_barang, jumlah_barang = :jumlah_barang WHERE id_barang = :id',
        [
            'id' => $id,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'harga_barang' => $request->harga_barang,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM barang WHERE id_barang = :id_barang', ['id_barang' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_barang', $id)->delete();

        return redirect()->route('barang.index')->with('success', 'Data Admin berhasil dihapus');
    }


}
