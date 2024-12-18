@extends('template.master')
@section('title', 'List Data Keranjang')
@section('judul', 'Data Keranjang')
@section('menuactive', 'List Keranjang')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="row">
        <!-- Kolom Barang (Lebar 8 kolom) -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Card untuk setiap barang -->
                        @forelse ($barangs as $barang)
                            <div class="col-md-4 mb-4 my-3">
                                <div class="card h-100" style="width: 100%; max-width: 20rem;">
                                    <img src="{{ asset('gambar_barang/' . $barang->gambar_barang) }}" class="card-img-top"
                                        alt="{{ $barang->nama_barang }}" style="height: 200px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                                        <strong>Stok : <em>{{ $barang->stok }}</em></strong>
                                        <p class="card-text">Rp.{{ number_format($barang->harga_barang, 3, ',', '.') }}</p>
                                        <form action="{{ url('tambah-keranjang/' . $barang->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mt-auto w-100">Tambah Ke
                                                Keranjang</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Tidak ada barang tersedia.</p>
                            </div>
                        @endforelse
                        <!-- Ulangi div di atas untuk setiap barang -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Keranjang (Lebar 4 kolom) -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5>Keranjang Belanja</h5>
                </div>
                <div class="card-body my-3">
                    <!-- Tampilkan daftar item yang ditambahkan ke keranjang -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data keranjang akan ditampilkan di sini -->
                            @forelse ($carts as $cart)
                                <tr>
                                    <td>{{ $cart->barang->nama_barang }}</td>
                                    <td>
                                        <form action="{{ url('forceupdate-keranjang', $cart->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" onkeypress="return hanyaAngka(event)" class="form-control"
                                                name="stok" id="stok" value="{{ $cart->stok }}">
                                        </form>
                                    </td>
                                    <td>{{ number_format($cart->totalharga, 3, '.', ',') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <form action="{{ url('increase-keranjang', $cart->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-plus-square-fill"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('decrease-keranjang', $cart->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="bi bi-file-minus-fill"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('delete-keranjang', $cart->id) }}" method="post"
                                                onclick="return confirm('yakin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @empty
                                    <div class="alert alert-danger my-3">Keranjang Kosong</div>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    @if ($carts->count() > 0)
                        <div class="mt-3">
                            <h6>Total:
                                Rp.{{ number_format( $carts->sum(function ($item) {
                                        return (float) str_replace(',', '', $item->totalharga);
                                    }),3, '.', ',',) 
                                    }}
                            </h6>
                            <form action="{{url('store-transaksi')}}" method="post">
                                @csrf
                                <button class="btn btn-success w-100">Bayar</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>
