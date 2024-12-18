@extends('template.master')
@section('title', 'Detail Transaksi')
@section('judul', 'Detail Transaksi')
@section('menuactive', 'Detail Transaksi')
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

    <div class="card">
        <div class="card-body my-3">
            <p><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Total Harga:</strong> {{ number_format($transaksi->total, 3, '.', ',') }}</p>
            <p><strong>Member ID:</strong> {{ $transaksi->id_members }}</p>
        </div>
    </div>

    <h4>Detail Produk</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi->detailtransaksi as $detail)
                <tr>
                    <td>{{ $detail->barangs->nama_barang }}</td>
                    <td>{{ $detail->kuantitas }}</td>
                    <td>{{ number_format($detail->barangs->harga_barang, 3, '.', ',') }}</td>
                    <td>{{ number_format($detail->kuantitas * $detail->barangs->harga_barang, 3, '.', ',') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada detail transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <td colspan="3" class="text-center">Total Pembayaran Anda : </td>
            <td colspan="2">{{number_format($transaksi->total,3,'.',',')}}</td>
        </tfoot>
    </table>
    <a href="{{url('transaksi')}}" class="btn btn-warning my-3">Back</a>
@endsection
