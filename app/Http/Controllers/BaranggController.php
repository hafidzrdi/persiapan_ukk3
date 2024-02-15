<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barangg;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use DB;


class BaranggController extends Controller
{
    public function index()
    {
        $rsetBarangg = Barangg::latest()->paginate(10);
        return view('v_barangg.index',compact('rsetBarangg'));
    }

    public function create()
    {
        $kategoriOptions = Kategori::all();                    
        return view('v_barangg.create',compact('kategoriOptions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'merk'              => 'required',
            'seri'              => 'required',
            'spesifikasi'       => 'required',
            'kategori_id'       => 'required',
        ]);

        Barangg::create([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'kategori_id'       => $request->kategori_id,
        ]);

        return redirect()->route('barangg.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetBarangg = Barangg::find($id);
        $rsetKategori = Kategori::select('id','deskripsi','kategori',
                        \DB::raw('(CASE
                            WHEN kategori = "M" THEN "Modal"
                            WHEN kategori = "A" THEN "Alat"
                            WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                            ELSE "Bahan Tidak Habis Pakai"
                            END) AS ketKategori'));
        return view('v_barangg.show', compact('rsetBarangg', 'rsetKategori'));
    }

    public function edit(string $id)
    {
        $kategoriOptions = Kategori::all();                    
        $rsetBarangg = Barangg::find($id);
        return view('v_barangg.edit', compact('rsetBarangg','kategoriOptions'));

    }

    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'merk'              => 'required',
            'seri'              => 'required',
            'spesifikasi'       => 'required',
            'stok'              => 'required', 
            'kategori_id'       => 'required',
        ]);

        $rsetBarangg = Barangg::find($id);

            $rsetBarangg->update([
                'merk'          => $request->merk,
                'seri'          => $request->seri,
                'spesifikasi'   => $request->spesifikasi,
                'stok'          => $request->stok,
                'kategori_id'   => $request->kategori_id,
            ]);

        return redirect()->route('barangg.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists()){
            return 'hello';
            return redirect()->route('barangg.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetBarangg = Barangg::find($id);
            $rsetBarangg->delete();
            return redirect()->route('barangg.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
