<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EkspedisiController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('select * from ekspedisi WHERE nama_ekspedisi like :search',[
            'search'=>'%'.$request->search.'%',
        ]);
        
        return view('ekspedisi.index')
            ->with('datas', $datas);
        }
        else{
            $datas = DB::select('select * from ekspedisi');
        
        return view('ekspedisi.index')
            ->with('datas', $datas);
        }
    }

    public function create() {
        return view('ekspedisi.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_ekspedisi' => 'required',
            'nama_ekspedisi' => 'required',
            'biaya_ekspedisi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO ekspedisi(id_ekspedisi, nama_ekspedisi, biaya_ekspedisi) VALUES (:id_ekspedisi, :nama_ekspedisi, :biaya_ekspedisi)',
        [
            'id_ekspedisi' => $request->id_ekspedisi,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'biaya_ekspedisi' => $request->biaya_ekspedisi,

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

        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('ekspedisi')->where('id_ekspedisi', $id)->first();

        return view('ekspedisi.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_ekspedisi' => 'required',
            'nama_ekspedisi' => 'required',
            'biaya_ekspedisi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE ekspedisi SET id_ekspedisi = :id_ekspedisi, nama_ekspedisi = :nama_ekspedisi, biaya_ekspedisi = :biaya_ekspedisi WHERE id_ekspedisi = :id',
        [
            'id' => $id,
            'id_ekspedisi' => $request->id_ekspedisi,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'biaya_ekspedisi' => $request->biaya_ekspedisi,
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->update([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'biaya_ekspedisi' => $request->biaya_ekspedisi,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('ekspedisi.index')->with('success', 'Data ekspedisi berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM ekspedisi WHERE id_ekspedisi = :id_ekspedisi', ['id_ekspedisi' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_ekspedisi', $id)->delete();

        return redirect()->route('ekspedisi.index')->with('success', 'Data Admin berhasil dihapus');
    }


}
