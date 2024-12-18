@extends('template.master')
@section('title', 'List Data Member')
@section('judul', 'Data Member')
@section('menuactive', 'List Member')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @forelse ($barangs as $barang)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ number_format($barang->harga_barang,3,'.','') }}</td>
                        <td>
                            <a href="{{ url('barang-edit/' . $barang->id) }}" class="btn btn-success"
                                style="display: inline-block;">Edit</a>
                            <form action="{{ url('barang-hapus/' . $barang->id) }}" method="post"
                                style="display: inline-block;" onsubmit="return confirm('yakin ??')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>

                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($barangs->count() == 0)
            <div class="alert alert-danger my-3">Data Barangnya Masih Kosong</div>
        @endif
    </div>
@endsection