## 🚀 Fitur & Modul Sistem

Sistem Informasi Koperasi Internal (**SIKOPI**) dibangun dengan konsep *integrated financial modules* dan pembagian hak akses (*Multi-Role Separation*) yang ketat antara Sekretaris dan Bendahara. Sistem ini dirancang untuk mengotomatisasi pencatatan buku kas utama, meminimalkan kesalahan manusia (*human error*), serta menjaga konsistensi saldo koperasi secara real-time.

---

## 👥 Modul Keanggotaan

Modul Keanggotaan berfungsi sebagai pusat pengelolaan data master seluruh anggota koperasi yang menjadi fondasi utama transaksi simpan-pinjam.

### Data Anggota (Tabel: `anggotas`)
- Mengelola master data anggota (CRUD).
- Mendukung fitur **Import CSV Anggota** untuk efisiensi input data dalam jumlah besar.
- Menampilkan profil ringkas, nomor anggota, NIP, dan unit kerja yang terintegrasi otomatis di form transaksi.

---

## 💰 Modul Simpanan

Modul Simpanan mengelola dana masuk dari anggota dengan mekanisme verifikasi ganda untuk menjaga validitas kas.

### Pengajuan Simpanan (Tabel: `simpanans`)
- **Sekretaris:** Melakukan input data simpanan meliputi `anggota_id`, `jenis`, `jumlah`, `tgl_bayar`, dan `keterangan`.
- Status awal simpanan yang diinput adalah `pending`.

### Verifikasi Simpanan
- **Bendahara:** Memiliki otoritas penuh untuk melakukan *Approve* atau *Reject* terhadap pengajuan simpanan.
- **Otomatisasi Sistem:** Saat Bendahara melakukan *Approve*, sistem secara otomatis akan:
  - Mengubah `status_verifikasi` menjadi approved dan mencatat `verified_by`.
  - Men-trigger pembuatan record baru pada Buku Kas Utama (`transaksis`) sebagai dana masuk.

---

## 📈 Modul Pinjaman & Angsuran

Modul Pinjaman mengadopsi aturan bisnis ketat (bunga flat dan batas tenor) di sisi backend serta otomatisasi pembuatan jadwal angsuran.

### Pengajuan Pinjaman (Tabel: `pinjaman`)
- **Sekretaris:** Menginput pengajuan pinjaman (`anggota_id`, `jenis_pinjaman`, `jumlah_pinjaman`, `tenor_bulan`, `keterangan`).
- **Aturan Bisnis Backend (Mutlak):**
  - **Pinjaman Konsumtif:** Bunga flat 6%, maksimal tenor 36 bulan.
  - **Pinjaman Darurat:** Bunga flat 2%, maksimal tenor 12 bulan.
- **Validasi Ketat:** Anggota yang masih memiliki pinjaman aktif (`status` = approved & `sisa_pinjaman` > 0) tidak dapat mengajukan pinjaman baru.

### Persetujuan & Otomatisasi Jadwal (Tabel: `angsuran`)
- **Bendahara:** Memeriksa, menyetujui (*Approve*), atau menolak (*Reject*) pengajuan.
- **Otomatisasi Sistem:** Saat Pinjaman di-*Approve*:
  - Sistem otomatis menghitung `total_kewajiban` dan `angsuran_perbulan`.
  - Sistem otomatis melakukan *looping* generate data jadwal angsuran pada tabel `angsuran` sebanyak `tenor_bulan` yang diajukan dengan status awal `pending`.

### Pembayaran Angsuran (Tahap Berikutnya)
- **Bendahara:** Mengeksekusi pembayaran angsuran anggota satu per satu.
- **Otomatisasi Sistem:** Setiap kali angsuran dibayar:
  - Mengubah status `angsuran` menjadi lunas.
  - Mengurangi `sisa_pinjaman` pada tabel `pinjaman`.
  - Jika `sisa_pinjaman` mencapai 0, otomatis mengubah status tabel `pinjaman` menjadi **Lunas**.
  - Men-trigger pembuatan record baru pada Buku Kas Utama (`transaksis`) sebagai kas masuk.

---

## 📑 Modul Buku Kas Utama & Laporan (Tahap Berikutnya)

Modul ini berfungsi sebagai muara dari seluruh aktivitas finansial di dalam koperasi.

### Transaksi Utama (Tabel: `transaksis`)
- Mencatat seluruh log keuangan (`anggota_id`, `jenis`, `kategori`, `reference_id`, `jumlah`, `saldo_setelah`).
- **Tidak menerima input manual.** Data hanya terisi melalui trigger otomatis dari modul simpanan yang disetujui dan angsuran yang dibayar.
- Menampilkan kalkulasi saldo akhir secara berkelanjutan (*running balance*).

---

## 🔗 Konsep Integrasi Keuangan

Beberapa prinsip utama yang diterapkan dalam sistem SIKOPI:

- ❌ **Tidak ada manipulasi saldo manual:** Saldo kas bertambah atau berkurang murni berdasarkan aksi *approval* dan transaksi yang valid.
- ✔ **Mekanisme Check & Balance:** Sekretaris bertindak sebagai *maker* (yang mengajukan), Bendahara bertindak sebagai *approver* (yang memverifikasi).
- ✔ **Otomatisasi Pencatatan Jurnal:** Persetujuan pinjaman otomatis memecah kewajiban menjadi tenor bulanan tanpa perlu dihitung manual oleh pengurus.
- ✔ **Keamanan Akses:** Seluruh endpoint dan *business logic* dilindungi oleh middleware `cek_login` dan dipisahkan secara rapi ke dalam namespace `Dashboard\Bendahara`.

## 👥 Contributors
Project ini dikembangkan secara kolaboratif oleh:
- [**Tegar Satria**](https://github.com/TegarSa)