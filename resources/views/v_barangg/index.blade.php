@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangg.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MERK</th>
                            <th>SERI</th>
                            <th>SPESIFIKASI</th>
                            <th>STOK</th>
                            <th>DESKRIPSI</th>
                            <th>KATEGORI</th>
                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetBarangg as $rowbarangg)
                            <tr>
                                <td>{{ $rowbarangg->id  }}</td>
                                <td>{{ $rowbarangg->merk  }}</td>
                                <td>{{ $rowbarangg->seri  }}</td>
                                <td>{{ $rowbarangg->spesifikasi  }}</td>
                                <td>{{ $rowbarangg->stok  }}</td>
                                <td>{{ $rowbarangg->kategori->deskripsi }}</td>
                                <td>{{ $rowbarangg->kategori->kategori }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                    action="{{ route('barangg.destroy', $rowbarangg->id) }}" method="POST">

                                        <a href="{{ route('barangg.show', $rowbarangg->id) }}" 
                                        class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('barangg.edit', $rowbarangg->id) }}" 
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
                {{$rsetBarangg->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
@endsection