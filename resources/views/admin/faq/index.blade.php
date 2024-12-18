@extends('template.master')
@section('title', 'List Data Faq')
@section('judul', 'Data Frently Asked Question')
@section('menuactive', 'List Faq')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Default Card -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Faq Baru</h5>
            <form action="{{ url('admin-newfaq') }}" class="row gy-2 gx-3 align-items-center" method="POST">
                @csrf
                <div class="col-auto col-sm-12">
                    <label for="autoSizingInputGroup">Pertanyaan</label>
                    <input type="text" class="form-control" id="autoSizingInput" name="pertanyaan">
                </div>
                <div class="col-auto col-sm-12">
                    <label for="autoSizingInputGroup">Jawaban</label>
                    <textarea name="jawaban" class="form-control" id="jawaban" cols="10" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- End Default Card -->
    <div class="accordion" id="membersAccordion">
        @forelse ($faqs as $faq)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $faq->pertanyaan }}</h5>
                    <div class="d-flex justify-content-start">
                        <button class="btn btn-primary h-50" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $faq->id }}">
                            Detail
                        </button>
                        <form class="ps-2" action="{{ url('admin-deletefaq', $faq->id) }}" method="post"
                            onsubmit="return confirm('yakin nih ??')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </div>
                    <div class="collapse" id="collapse{{ $faq->id }}"  data-bs-parent="#membersAccordion">
                        <div class="card card-body my-3">
                            <form action="{{ url('admin-updatefaq', $faq->id) }}" class="row gy-2 gx-3 align-items-center"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-auto col-sm-12">
                                    <label for="autoSizingInputGroup">Pertanyaan</label>
                                    <input type="text" class="form-control" id="autoSizingInput" name="pertanyaan"
                                        value="{{ $faq->pertanyaan }}">
                                </div>
                                <div class="col-auto col-sm-12">
                                    <label for="autoSizingInputGroup">Jawaban</label>
                                    <textarea name="jawaban" class="form-control" id="jawaban" cols="10" rows="5">{{ $faq->jawaban }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger my-3">Data Faq Masih Kosong</div>
        @endforelse
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
