@extends('template.master')
@section('title', 'Form Edit Barang')
@section('judul', 'Edit Barang')
@section('menuactive', 'Edit Barang')
@section('content')
    <form action="{{ url('barang-update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Tambahkan metode PUT untuk update -->

        <!-- Nama Barang -->
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                name="nama_barang" placeholder="Masukkan nama barang" value="{{ old('nama_barang', $barang->nama_barang) }}">
            @error('nama_barang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gambar Barang -->
        <div class="mb-3">
            <label for="gambar_barang" class="form-label">Gambar Barang</label>
            <input type="file" class="form-control @error('gambar_barang') is-invalid @enderror" id="gambar_barang"
                name="gambar_barang">
            @error('gambar_barang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <!-- Tampilkan gambar saat ini -->
            @if ($barang->gambar_barang)
                <img src="{{ asset('gambar_barang/' . $barang->gambar_barang) }}" alt="Gambar Barang" class="mt-2"
                    width="150">
            @endif
        </div>

        <!-- Harga Barang -->
        <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang</label>
            <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" id="harga_barang"
                name="harga_barang" placeholder="Masukkan harga barang"
                value="{{ old('harga_barang', $barang->harga_barang) }}">
            @error('harga_barang')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stok Barang -->
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Barang</label>
            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                placeholder="Masukkan stok barang" value="{{ old('stok', $barang->stok) }}">
            @error('stok')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-success w-100 my-3">Update Barang</button>
        <a href="{{url('barang')}}" class="btn btn-warning my-3">Back</a>
    </form>
@endsection
