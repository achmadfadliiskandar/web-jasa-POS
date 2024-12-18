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
            <h5 class="card-title">Tambah Member Baru</h5>
            <form action="{{ url('admin-newmember') }}" class="row gy-2 gx-3 align-items-center" method="POST">
                @csrf
                <div class="col-auto col-sm-2">
                    <label for="autoSizingInput">Pilih Paket</label>
                    <select class="form-select" id="autoSizingSelect" name="id_pakets">
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}">{{ $paket->durasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto col-sm-2">
                    <label for="autoSizingInputGroup">Username</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <select class="form-select" id="autoSizingSelect" name="nama_member">
                            @foreach ($usermembers as $usermember)
                                <option value="{{ $usermember->name }}">{{ $usermember->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-auto col-sm-2">
                    <label for="autoSizingInputGroup">Nomor Telephone</label>
                    <input type="text" class="form-control" id="autoSizingInput" name="telepon"
                        placeholder="081234567778" onkeypress="return hanyaAngka(event)">
                </div>
                <div class="col-auto col-sm-2">
                    <label for="autoSizingInputGroup">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="autoSizingInput" name="tanggal_mulai"
                        placeholder="01/11/2024">
                </div>
                <div class="col-auto col-sm-4">
                    <label for="autoSizingInputGroup">Tangal Selesai</label>
                    <input type="date" class="form-control" id="autoSizingInput" name="tanggal_selesai"
                        placeholder="01/12/2024">
                </div>
                <div class="col-auto col-sm-12">
                    <label for="floatingTextarea">Alamat</label>
                    <textarea class="form-control" placeholder="isi alamatnya" id="alamat" name="alamat"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- End Default Card -->
    <div class="accordion" id="membersAccordion">
        @forelse ($members as $member)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $member->nama_member }}</h5>
                    <div class="d-flex justify-content-start">
                        <button class="btn btn-primary h-50" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $member->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $member->id }}">
                            Detail Member
                        </button>
                        <form class="ps-2" action="{{ url('admin-deletemember', $member->id) }}" method="post"
                            onsubmit="return confirm('yakin nih ??')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Cabut Member</button>
                        </form>
                    </div>
                    <div class="collapse" id="collapse{{ $member->id }}" data-bs-parent="#membersAccordion">
                        <div class="card card-body my-3">
                            <form action="{{ url('admin-updatemember', $member->id) }}"
                                class="row gy-2 gx-3 align-items-center" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-auto col-sm-3">
                                    <label for="autoSizingInput">Pilih Paket</label>
                                    <select class="form-select" id="autoSizingSelect" name="id_pakets">
                                        @foreach ($pakets as $paket)
                                            <option value="{{ $paket->id }}"
                                                @if ($paket->id == $member->id_pakets) selected @endif>{{ $paket->durasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto col-sm-3">
                                    <label for="autoSizingInputGroup">Nomor Telephone</label>
                                    <input type="text" class="form-control" id="autoSizingInput" name="telepon"
                                        onkeypress="return hanyaAngka(event)" value="{{ $member->telepon }}">
                                </div>
                                <div class="col-auto col-sm-2">
                                    <label for="autoSizingInputGroup">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="autoSizingInput" id="tanggal_mulai"
                                        name="tanggal_mulai" placeholder="01/11/2024"
                                        value="{{ $member->tanggal_mulai }}">
                                </div>
                                <div class="col-auto col-sm-4">
                                    <label for="autoSizingInputGroup">Tangal Selesai</label>
                                    <input type="date" class="form-control" id="autoSizingInput" id="tanggal_selesai"
                                        name="tanggal_selesai" placeholder="01/12/2024"
                                        value="{{ $member->tanggal_selesai }}">
                                </div>
                                <div class="col-auto col-sm-12">
                                    <label for="floatingTextarea">Alamat</label>
                                    <textarea class="form-control" placeholder="isi alamatnya" id="alamat" name="alamat">{{ $member->alamat }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger my-3">Data Membernya Masih Kosong</div>
        @endforelse
    </div>


    @if ($members->count() == 0)
        <div class="alert alert-danger">Tidak Ada Member</div>
    @endif
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tanggalMulaiInput = document.querySelector('input[name="tanggal_mulai"]');
        const tanggalSelesaiInput = document.querySelector('input[name="tanggal_selesai"]');

        // Set default value for tanggal_mulai to today's date in YYYY-MM-DD format
        const todayFormatted = moment().format('YYYY-MM-DD');
        tanggalMulaiInput.value = todayFormatted;
        tanggalMulaiInput.setAttribute('min', todayFormatted);

        // Set default value for tanggal_selesai to one day after today's date
        const tomorrowFormatted = moment().add(1, 'days').format('YYYY-MM-DD');
        tanggalSelesaiInput.value = tomorrowFormatted;
        tanggalSelesaiInput.setAttribute('min', tomorrowFormatted);

        tanggalMulaiInput.addEventListener('change', function() {
            const tanggalMulai = moment(this.value);
            if (tanggalMulai.isValid()) {
                // Set minimum date for tanggal_selesai as one day after tanggal_mulai
                const tanggalSelesaiMin = tanggalMulai.add(1, 'days').format('YYYY-MM-DD');
                tanggalSelesaiInput.value = tanggalSelesaiMin;
                tanggalSelesaiInput.setAttribute('min', tanggalSelesaiMin);
            }
        });
    });

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>
