<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barangg;

class KategoriController extends Controller
{
     public function index()
     {  
        $rsetKategori = Kategori::select('id','deskripsi','kategori',
            \DB::raw('(CASE
                WHEN kategori = "M" THEN "Modal"
                WHEN kategori = "A" THEN "Alat"
                WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                ELSE "Bahan Tidak Habis Pakai"
                END) AS ketKategori'))
            ->paginate(10);
            return view('v_kategori.index', compact('rsetKategori'));
    }
    
    public function create()
    {
        return view('v_kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi'     => 'required',
            'kategori'  => 'required',
            
        ]);
    
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
        ]);
    
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetKategori = Kategori::select('id', 'deskripsi', 'kategori',
            \DB::raw('(CASE
                WHEN kategori = "M" THEN "Modal"
                WHEN kategori = "A" THEN "Alat"
                WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                ELSE "Bahan Tidak Habis Pakai"
                END) AS ketKategori'))
            ->where('id', '=', $id)
            ->first();

        return view('v_kategori.show', compact('rsetKategori'));
    }

    public function edit(string $id)
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                        'M'=>'Barang Modal',
                        'A'=>'Alat',
                        'BHP'=>'Bahan Habis Pakai',
                        'BTHP'=>'Bahan Tidak Habis Pakai'
                    );

        $rsetKategori = Kategori::find($id);
        return view('v_kategori.edit', compact('rsetKategori','aKategori'));

    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'deskripsi'             => 'required',
            'kategori'              => 'required',
            
        ]);

        $rsetKategori = Kategori::find($id);
        $rsetKategori->update([
            'deskripsi'     => $request->deskripsi,
            'kategori'      => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {

        if (DB::table('barangg')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }

    function getAPIKategori(){
        $rsetKategori = Kategori::all();
        $data = array("data"=>$rsetKategori);

        return response()->json($data);
    }

    function getAPIKategori1($id){
        $rsetKategori = Kategori::find($id);
        $data = array("data"=>$rsetKategori);
        return response()->json($data);
    }
}
