<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use App\Models\Barangg;

class KategoriiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rsetKategori = Kategori::all();
        // return $rsetKategori;
         //Memanggil store procedure : OK
        // $rsetKategori = DB::select('CALL getKategoriAll');
        $rsetKategori = Kategori::latest()->paginate(10);
        return view('v_kategori.index', compact(rsetKategori));
        //  return view('v_kategori.index');

        // $rsetKategori = Kategori::latest()->paginate(10);
        // $rsetKategori = Kategori::find(1)->barangs();

        // dd($rsetKategori);
        // return $rsetKategori->all();

        // $rsetKategori = DB::table('kategori')->paginate(2);

        // $rsetKategori = DB::table('kategori')
        //     ->select('id','kategori', 'jenis')
        //     ->paginate(2);


        // $rsetKategori = Kategori::select('id','deskripsi','kategori',
        //     \DB::raw('(CASE
        //         WHEN kategori = "M" THEN "Modal"
        //         WHEN kategori = "A" THEN "Alat"
        //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategori'))
        //     ->paginate(2);
        // //  OK

        // $rsetKategori = DB::select('CALL getKategoriAll()','ketKategori("M")');
        // $rsetKategori = DB::raw("SELECT ketKategori("M") as someValue') ;

        // $rsetKategori = DB::table('kategori')
        //      ->select('id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'))
        //      ->get();

       // return $rsetKategori;


        // $rsetKategori = DB::table('kategori')
        //                 ->select('id','deskripsi',DB::raw('ketKategori(kategori) as ketkategori'))->paginate(1);



        //  return view('v_kategori.index',compact('rsetKategori'));

        // $rsetKategori = Kategori::all();
        // return view('v_kategori.relasi', compact('rsetKategori'));



        // return DB::table('kategori')->get();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                            'M'=>'Barang Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai'
                            );
        return view('v_kategori.create',compact('aKategori'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            
            'kategori'     => 'required | in:M,A,BHP,BTHP',
            'jenis'   => 'required',
        ]);


        //create post
        Kategori::create([
            'deskripsi'  => $request->deskripsi,
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $rsetKategori = Kategori::find($id);

    //     // $rsetKategori = Kategori::select('id','deskripsi','kategori',
    //     //     \DB::raw('(CASE
    //     //         WHEN kategori = "M" THEN "Modal"
    //     //         WHEN kategori = "A" THEN "Alat"
    //     //         WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
    //     //         ELSE "Bahan Tidak Habis Pakai"
    //     //         END) AS ketKategori'))->where('id', '=', $id);

    //     return view('v_kategori.show', compact('rsetKategori'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
