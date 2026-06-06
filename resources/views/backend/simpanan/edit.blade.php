@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

<div class="mb-3">
    <h1 class="align-middle h3 d-inline">Edit Simpanan</h1>
</div>

<div class="row justify-content-center">

    <div class="col-12">

        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-end">
                        <a href="{{ route('simpanan.index') }}"
                           class="btn btn-warning">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <form action="{{ route('simpanan.update', $simpanan->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- ANGGOTA --}}
                    <div class="mb-3 row">

                        <label class="col-form-label col-sm-2 text-sm-end">
                            Anggota
                        </label>

                        <div class="col-sm-10">

                            <select name="anggota_id"
                                    class="form-select @error('anggota_id') is-invalid @enderror">

                                <option value="">
                                    -- Pilih Anggota --
                                </option>

                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}"
                                        {{ old('anggota_id', $simpanan->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->no_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach

                            </select>

                            @error('anggota_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- JENIS SIMPANAN --}}
                    <div class="mb-3 row">

                        <label class="col-form-label col-sm-2 text-sm-end">
                            Jenis Simpanan
                        </label>

                        <div class="col-sm-10">

                            <select name="jenis"
                                    class="form-select @error('jenis') is-invalid @enderror">

                                <option value="pokok"
                                    {{ old('jenis', $simpanan->jenis) == 'pokok' ? 'selected' : '' }}>
                                    Simpanan Pokok
                                </option>

                                <option value="wajib"
                                    {{ old('jenis', $simpanan->jenis) == 'wajib' ? 'selected' : '' }}>
                                    Simpanan Wajib
                                </option>

                                <option value="sukarela"
                                    {{ old('jenis', $simpanan->jenis) == 'sukarela' ? 'selected' : '' }}>
                                    Simpanan Sukarela
                                </option>

                            </select>

                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- JUMLAH --}}
                    <div class="mb-3 row">

                        <label class="col-form-label col-sm-2 text-sm-end">
                            Jumlah Simpanan
                        </label>

                        <div class="col-sm-10">

                            <input type="number"
                                   name="jumlah"
                                   value="{{ old('jumlah', $simpanan->jumlah) }}"
                                   class="form-control @error('jumlah') is-invalid @enderror"
                                   placeholder="Masukkan jumlah simpanan">

                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- TANGGAL BAYAR --}}
                    <div class="mb-3 row">

                        <label class="col-form-label col-sm-2 text-sm-end">
                            Tanggal Bayar
                        </label>

                        <div class="col-sm-10">

                            <input type="date"
                                   name="tgl_bayar"
                                   value="{{ old('tgl_bayar', $simpanan->tgl_bayar) }}"
                                   class="form-control @error('tgl_bayar') is-invalid @enderror">

                            @error('tgl_bayar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="mb-3 row">

                        <label class="col-form-label col-sm-2 text-sm-end">
                            Keterangan
                        </label>

                        <div class="col-sm-10">

                            <textarea name="keterangan"
                                      rows="4"
                                      class="form-control @error('keterangan') is-invalid @enderror"
                                      placeholder="Masukkan keterangan">{{ old('keterangan', $simpanan->keterangan) }}</textarea>

                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mb-3 row">

                        <div class="col-sm-10 ms-sm-auto">

                            <button type="submit"
                                    class="btn btn-primary">
                                Simpan Perubahan
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
