<?php

namespace App\Http\Controllers;
use App\Models\Barangmasuk;
use App\Models\Barangg;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangmasukController extends Controller
{
    public function index()
    {
        $rsetBarangmasuk = Barangmasuk::latest()->paginate(10);
        return view('v_barangmasuk.index',compact('rsetBarangmasuk'));
    }

    public function create()
    {
        $baranggOptions = Barangg::all();       
        return view('v_barangmasuk.create', compact('baranggOptions'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate( [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        // Simpan data barang masuk ke database
        Barangmasuk::create([
            'tgl_masuk'          => $request->tgl_masuk,
            'qty_masuk'          => $request->qty_masuk,
            'barang_id'          => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus');
    }

    public function show(string $id)
    {
        $rsetBarangmasuk = Barangmasuk::find($id);
        return view('v_barangmasuk.show', compact('rsetBarangmasuk'));
    }

    public function edit(string $id)
    {
        $rsetBarangmasuk = Barangmasuk::find($id);
        $selectedbarang = Barangg::find($rsetBarangmasuk->barang_id); 
        return view('v_barangmasuk.edit', compact('rsetBarangmasuk','selectedbarang'));

    }

    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'tgl_masuk'              => 'required',
            'qty_masuk'              => 'required',
        ]); 

        $rsetBarangmasuk = Barangmasuk::find($id);

            $rsetBarangmasuk->update([
                'tgl_masuk'          => $request->tgl_masuk,
                'qty_masuk'          => $request->qty_masuk,
            ]);

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        // Hapus data barang masuk berdasarkan ID
        Barangmasuk::findOrFail($id)->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
}
