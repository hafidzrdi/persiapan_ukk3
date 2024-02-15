<?php

namespace App\Http\Controllers;
use App\Models\Barangkeluar;
use App\Models\Barangg;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $rsetBarangkeluar = Barangkeluar::latest()->paginate(10);
        return view('v_barangkeluar.index',compact('rsetBarangkeluar'));
    }

    public function create()
    {
        $baranggOptions = Barangg::all();       
        return view('v_barangkeluar.create', compact('baranggOptions'));
    }

    public function store(Request $request)
    {
        $request->validate( [
            'tgl_keluar' => 'required',
            'qty_keluar' => 'required',
            'barang_id' => 'required',
        ]);

        Barangkeluar::create([
            'tgl_keluar'          => $request->tgl_keluar,
            'qty_keluar'          => $request->qty_keluar,
            'barang_id'          => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index');
    }

    
    public function show(string $id)
    {
        $rsetBarangkeluar = Barangkeluar::find($id);
        return view('v_barangkeluar.show', compact('rsetBarangkeluar'));
    }

    public function edit(string $id)
    {
        $rsetBarangkeluar = Barangkeluar::find($id);
        $selectedbarang = Barangg::find($rsetBarangkeluar->barang_id); 
        return view('v_barangkeluar.edit', compact('rsetBarangkeluar','selectedbarang'));

    }

    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'tgl_keluar'              => 'required',
            'qty_keluar'              => 'required',
        ]);

        $rsetBarangkeluar = Barangkeluar::find($id);

            $rsetBarangkeluar->update([
                'tgl_keluar'          => $request->tgl_keluar,
                'qty_keluar'          => $request->qty_keluar,
            ]);

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        // Hapus data barang masuk berdasarkan ID
        Barangkeluar::findOrFail($id)->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
}
