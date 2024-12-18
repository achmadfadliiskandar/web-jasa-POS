@extends('template.master')
@section('title', 'List Data Transaksi')
@section('judul', 'Data Transaksi')
@section('menuactive', 'List Transaksi')
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Total Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data keranjang akan ditampilkan di sini -->
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{$transaksi->tanggal_transaksi}}</td>
                    <td>{{number_format($transaksi->total,3,'.','')}}</td>
                    <td>
                        <a href="{{url('transaksi-detail',$transaksi->id)}}" class="btn btn-info">Lihat Detail</a>
                    </td>
                @empty
                    <div class="alert alert-danger my-3">Transaksi Kosong</div>
            @endforelse
            </tr>
        </tbody>
    </table>
@endsection