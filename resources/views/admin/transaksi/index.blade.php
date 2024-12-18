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
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @forelse ($transaksis as $transaksi)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->tanggal_transaksi }}</td>
                        <td>{{ number_format($transaksi->total,3,".","") }}</td>
                        <td><a href="{{url('admin-detailtransaksi',$transaksi->id)}}" class="btn btn-info">Lihat Detail</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($transaksis->count() == 0)
            <div class="alert alert-danger my-3">Data Transaksinya Masih Kosong</div>
        @endif
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