@extends('template.master')

@section('title', 'Data Kritik-Saran')
@section('judul', 'List Kritik Saran')
@section('menuactive', 'Kritik-Saran')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kritik & Saran</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kritiksarans as $index => $kritiksaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kritiksaran->nama }}</td>
                    <td>{{ $kritiksaran->email }}</td>
                    <td>{{ $kritiksaran->kritik_saran }}</td>
                    <td>
                        <form action="{{ url('admin-deleteks', $kritiksaran->id) }}" method="post"
                            onsubmit="return confirm('yakin nih?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <td class="text-danger text-center" colspan="4">data tidak ada</td>
            @endforelse
        </tbody>
    </table>
@endsection
