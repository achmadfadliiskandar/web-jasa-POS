@extends('template.master')
@section('title', 'List Data Pengguna')
@section('judul', 'Data Pengguna')
@section('menuactive', 'List Pengguna')
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
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @forelse ($users as $user)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ url('admin-edituser/' . $user->id) }}" class="btn btn-success"
                                style="display: inline-block;">Edit</a>
                            <form action="{{ url('admin-deleteuser/' . $user->id) }}" method="post"
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
        @if ($users->count() == 0)
            <div class="alert alert-danger my-3">Data Usernya Masih Kosong</div>
        @endif
    </div>
@endsection
