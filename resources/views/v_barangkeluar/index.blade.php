@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-3">BARANG KELUAR</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>BARANG</th>
                            <th>SERI</th>
                            <th>STOK SAAT INI</th>
                            <th>TANGGAL KELUAR</th>
                            <th>QTY KELUAR</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetBarangkeluar as $barangkeluar)
                            <tr>
                                <td>{{ $barangkeluar->barangg->merk  }}</td>
                                <td>{{ $barangkeluar->barangg->seri  }}</td>
                                <td>{{ $barangkeluar->barangg->stok  }}</td>
                                <td>{{ $barangkeluar->tgl_keluar  }}</td>
                                <td>{{ $barangkeluar->qty_keluar  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                    action="{{ route('barangkeluar.destroy', $barangkeluar->id) }}" method="POST">

                                        <a href="{{ route('barangkeluar.show', $barangkeluar->id) }}" 
                                        class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('barangkeluar.edit', $barangkeluar->id) }}" 
                                        class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert">
                                Data Barang belum tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection