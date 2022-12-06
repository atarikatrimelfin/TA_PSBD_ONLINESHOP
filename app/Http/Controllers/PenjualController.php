<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{
        public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from penjual WHERE nama_penjual like :search AND recycle=0',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        $datasrecycle = DB::select('select * from penjual WHERE nama_penjual like :search AND recycle=1',[
            'search'=>'%'.$request->search.'%',
        ]);

        return view('penjual.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);
        }
       else{
        $datas = DB::select('select * from penjual WHERE recycle=0');
        $datasrecycle = DB::select('select * from penjual WHERE recycle=1');

        return view('penjual.index')
            ->with('datas', $datas)
            ->with('datasrecycle', $datasrecycle);   
       } 
    }

    public function create() {
        return view('penjual.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_penjual' => 'required',
            'nama_penjual' => 'required',
            'id_barang' => 'required',
            'notelp_penjual' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO penjual(id_penjual, nama_penjual, id_barang, notelp_penjual) VALUES (:id_penjual, :nama_penjual, :id_barang, :notelp_penjual)',
        [
            'id_penjual' => $request->id_penjual,
            'nama_penjual' => $request->nama_penjual,
            'id_barang' => $request->id_barang,
            'notelp_penjual' => $request->notelp_penjual,

        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'notelp' => $request->notelp,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('penjual.index')->with('success', 'Data penjual berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('penjual')->where('id_penjual', $id)->first();

        return view('penjual.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_penjual' => 'required',
            'nama_penjual' => 'required',
            'id_barang' => 'required',
            'notelp_penjual' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE penjual SET id_penjual = :id_penjual, nama_penjual = :nama_penjual, id_barang = :id_barang, notelp_penjual = :notelp_penjual WHERE id_penjual = :id',
        [
            'id' => $id,
            'id_penjual' => $request->id_penjual,
            'nama_penjual' => $request->nama_penjual,
            'id_barang' => $request->id_barang,
            'notelp_penjual' => $request->notelp_penjual,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'notelp_penjual' => $request->notelp_penjual,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('penjual.index')->with('success', 'Data penjual berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM penjual WHERE id_penjual = :id_penjual', ['id_penjual' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_penjual', $id)->delete();

        return redirect()->route('penjual.index')->with('success', 'Data Admin berhasil dihapus');
    }
    
    public function recycle($id) {
        DB::update('UPDATE penjual set recycle = 1 WHERE id_penjual = :id_penjual', ['id_penjual' => $id]);
        return redirect()->route('penjual.index')->with('success', 'Data Penjual berhasil dihapus');
    }
    public function restore($id) {
        DB::update('UPDATE penjual set recycle = 0 WHERE id_penjual = :id_penjual', ['id_penjual' => $id]);
        return redirect()->route('penjual.index')->with('success', 'Data Penjual berhasil dihapus');
    }


}
