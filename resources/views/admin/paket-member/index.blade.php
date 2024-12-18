@extends('template.master')
@section('title', 'Data Paket Member')
@section('judul', 'Paket Member')
@section('menuactive', 'Paket Member')
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
                    <th scope="col">Durasi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @forelse ($paketmembers as $paketmember)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $paketmember->durasi }}</td>
                        <td>{{ number_format($paketmember->harga,3,'.',',') }}</td>
                        <td>{{ $paketmember->status }}</td>
                        <td>
                            <a href="{{ url('admin-editpaketmember/' . $paketmember->id) }}" class="btn btn-success"
                                style="display: inline-block;">Edit</a>
                            <form action="{{ url('admin-deletepaketmember/' . $paketmember->id) }}" method="post"
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
        @if ($paketmembers->count() == 0)
            <div class="alert alert-danger my-3">Paket Membernya Masih Kosong</div>
        @endif
    </div>
@endsection
