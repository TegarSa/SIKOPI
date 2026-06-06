@extends('backend.layouts.index')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Edit Pinjaman</h1>
    </div>

    <div class="row justify-content-center">

        <div class="col-12">

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center p-3" role="alert">
                    <div class="stat text-danger bg-danger-light p-2 rounded-circle me-3 d-flex align-items-center justify-content-center">
                        <i class="align-middle" data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
                    </div>
                    <div class="grow">
                        <h5 class="fw-bold text-danger mb-0 text-uppercase small tracking-wider">Gagal Memproses</h5>
                        <span class="text-muted small">{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">

                <div class="card-header text-end">
                    <a href="{{ route('pinjaman.index') }}"
                       class="btn btn-warning">
                        Kembali
                    </a>
                </div>

                <div class="card-body">

                    <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- ANGGOTA (Disabled/Readonly biasanya saat edit, tapi tetap dikirim ID-nya) --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Anggota</label>
                            <div class="col-sm-10">
                                <select name="anggota_id" id="anggotaSelect" class="form-select @error('anggota_id') is-invalid @enderror">
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}" 
                                            {{ $pinjaman->anggota_id == $anggota->id ? 'selected' : '' }}
                                            data-nama="{{ $anggota->nama }}" 
                                            data-nip="{{ $anggota->nip }}" 
                                            data-unit="{{ $anggota->unit_kerja }}">
                                            {{ $anggota->no_anggota }} - {{ $anggota->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- DETAIL ANGGOTA --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Detail</label>
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    <div>Nama : <b id="namaText">{{ $pinjaman->anggota->nama ?? '-' }}</b></div>
                                    <div>NIP : <b id="nipText">{{ $pinjaman->anggota->nip ?? '-' }}</b></div>
                                    <div>Unit : <b id="unitText">{{ $pinjaman->anggota->unit_kerja ?? '-' }}</b></div>
                                </div>
                            </div>
                        </div>

                        {{-- JENIS PINJAMAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jenis Pinjaman</label>
                            <div class="col-sm-10">
                                <select name="jenis_pinjaman" id="jenis_pinjaman" class="form-select" required>
                                    <option value="konsumtif" {{ $pinjaman->jenis_pinjaman == 'konsumtif' ? 'selected' : '' }}>Pinjaman Konsumtif (Bunga 6%, Max 36 Bulan)</option>
                                    <option value="darurat" {{ $pinjaman->jenis_pinjaman == 'darurat' ? 'selected' : '' }}>Pinjaman Darurat (Bunga 2%, Max 12 Bulan)</option>
                                </select>
                            </div>
                        </div>

                        {{-- JUMLAH PINJAMAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Jumlah Pinjaman</label>
                            <div class="col-sm-10">
                                <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" value="{{ $pinjaman->jumlah_pinjaman }}" required>
                            </div>
                        </div>

                        {{-- TENOR --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Lama Pinjaman (Bulan)</label>
                            <div class="col-sm-10">
                                <input type="number" name="tenor_bulan" id="tenor_bulan" class="form-control" min="1" max="{{ $pinjaman->jenis_pinjaman == 'konsumtif' ? 36 : 12 }}" value="{{ $pinjaman->tenor_bulan }}" required>
                                <small class="text-muted" id="tenor_info">Maksimal pengajuan: {{ $pinjaman->jenis_pinjaman == 'konsumtif' ? 36 : 12 }} bulan.</small>
                            </div>
                        </div>

                        {{-- BUNGA --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Bunga Flat (%)</label>
                            <div class="col-sm-10">
                                <input type="number" name="bunga_flat" id="bunga_flat" class="form-control bg-light" value="{{ $pinjaman->bunga_flat }}" readonly>
                            </div>
                        </div>

                        {{-- SIMULASI --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Simulasi Real-time</label>
                            <div class="col-sm-10">
                                <div class="border rounded p-3 bg-light">
                                    <div>Total Kewajiban : <b id="totalKewajiban" class="text-primary">Rp 0</b></div>
                                    <div>Angsuran Per Bulan : <b id="angsuranBulanan" class="text-success">Rp 0</b></div>
                                </div>
                            </div>
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label text-sm-end">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" rows="3" class="form-control">{{ $pinjaman->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-10 ms-sm-auto">
                                <button type="submit" class="btn btn-success">Update Pinjaman</button>
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
document.addEventListener("DOMContentLoaded", function () {
    const jenisPinjaman   = document.getElementById('jenis_pinjaman');
    const bungaFlat       = document.getElementById('bunga_flat');
    const tenorBulan      = document.getElementById('tenor_bulan');
    const tenorInfo       = document.getElementById('tenor_info');
    const jumlahPinjaman  = document.getElementById('jumlah_pinjaman');
    const totalKewajibanTxt  = document.getElementById('totalKewajiban');
    const angsuranBulananTxt = document.getElementById('angsuranBulanan');
    const anggotaSelect   = document.getElementById('anggotaSelect');

    jenisPinjaman.addEventListener('change', function () {
        if (this.value === 'konsumtif') {
            bungaFlat.value = 6;
            tenorBulan.max = 36;
            tenorBulan.value = Math.min(tenorBulan.value, 36); 
            tenorInfo.textContent = "Maksimal pengajuan: 36 bulan.";
        } else if (this.value === 'darurat') {
            bungaFlat.value = 2;
            tenorBulan.max = 12;
            tenorBulan.value = Math.min(tenorBulan.value, 12); 
            tenorInfo.textContent = "Maksimal pengajuan: 12 bulan.";
        }
        hitungSimulasi();
    });

    [jumlahPinjaman, tenorBulan].forEach(element => {
        element.addEventListener('input', hitungSimulasi);
    });

    function hitungSimulasi() {
        const principal = parseFloat(jumlahPinjaman.value) || 0;
        const rate      = parseFloat(bungaFlat.value) || 0;
        const months    = parseInt(tenorBulan.value) || 0;

        if (principal > 0 && months > 0) {
            const totalBunga = (principal * rate / 100) * (months / 12);
            const totalKewajiban = principal + totalBunga;
            const angsuranPerbulan = totalKewajiban / months;

            totalKewajibanTxt.innerText = "Rp " + totalKewajiban.toLocaleString('id-ID', { maximumFractionDigits: 0 });
            angsuranBulananTxt.innerText = "Rp " + angsuranPerbulan.toLocaleString('id-ID', { maximumFractionDigits: 0 });
        } else {
            totalKewajibanTxt.innerText = "Rp 0";
            angsuranBulananTxt.innerText = "Rp 0";
        }
    }

    if (anggotaSelect) {
        anggotaSelect.addEventListener('change', function() {
            let selected = this.options[this.selectedIndex];
            document.getElementById('namaText').innerText = selected.dataset.nama || '-';
            document.getElementById('nipText').innerText  = selected.dataset.nip || '-';
            document.getElementById('unitText').innerText = selected.dataset.unit || '-';
        });
    }

    // Jalankan hitung simulasi sekali saat load pertama kali (karena ini edit data)
    hitungSimulasi();
});
</script>

@endpush