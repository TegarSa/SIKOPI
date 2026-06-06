@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Tambah Simpanan</h1>
    </div>

    <div class="row justify-content-center">

        <div class="col-12">

            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('simpanan.index') }}" class="btn btn-warning">
                        Kembali
                    </a>
                </div>

                <div class="card-body">

                    <form action="{{ route('simpanan.store') }}" method="POST">
                        @csrf

                        {{-- ANGGOTA --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Anggota</label>

                            <div class="col-sm-10">

                                <select name="anggota_id" id="anggotaSelect" class="form-select">
                                    <option value="">-- Pilih Anggota --</option>

                                    @foreach($anggotas as $a)
                                        <option value="{{ $a->id }}"
                                            data-nama="{{ $a->nama }}"
                                            data-nip="{{ $a->nip }}"
                                            data-unit="{{ $a->unit_kerja }}">
                                            {{ $a->no_anggota }} - {{ $a->nama }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        {{-- DETAIL --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Detail</label>

                            <div class="col-sm-10">
                                <div class="border p-3 rounded bg-light">
                                    <div>Nama: <b id="namaText">-</b></div>
                                    <div>NIP: <b id="nipText">-</b></div>
                                    <div>Unit: <b id="unitText">-</b></div>
                                </div>
                            </div>
                        </div>

                        {{-- JENIS (FIXED) --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jenis</label>

                            <div class="col-sm-10">

                                <select name="jenis" class="form-select">

                                    <option value="pokok">Pokok</option>
                                    <option value="wajib">Wajib</option>
                                    <option value="sukarela">Sukarela</option>

                                </select>

                            </div>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jumlah</label>

                            <div class="col-sm-10">
                                <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah">
                            </div>
                        </div>

                        {{-- TANGGAL (FIXED) --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Tanggal</label>

                            <div class="col-sm-10">
                                <input type="date" name="tgl_bayar" class="form-control">
                            </div>
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Keterangan</label>

                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('js')

<script>
document.getElementById('anggotaSelect').addEventListener('change', function () {

    let selected = this.options[this.selectedIndex];

    document.getElementById('namaText').innerText = selected.dataset.nama || '-';
    document.getElementById('nipText').innerText = selected.dataset.nip || '-';
    document.getElementById('unitText').innerText = selected.dataset.unit || '-';

});
</script>

@endpush