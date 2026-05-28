## 🚀 Fitur & Modul Sistem

Sistem **SCM Konveksi** dibangun dengan konsep *integrated modules*, di mana setiap modul saling terhubung dan berbagi data. Sistem ini dirancang untuk meminimalkan input manual, menjaga konsistensi data, serta merepresentasikan alur Supply Chain Management (SCM) pada usaha konveksi secara nyata.

---

## 📦 Modul Inventory

Modul Inventory berfungsi sebagai pusat pengelolaan stok barang atau bahan baku konveksi.

### Daftar Stok
- Menampilkan jumlah stok aktual setiap barang
- **Tidak menerima input manual**
- Data stok dihitung otomatis berdasarkan:
  - Transaksi stok masuk
  - Transaksi stok keluar
  - Purchase Order yang telah diproses
- Bertujuan menjaga akurasi data stok secara real-time

### Stok Masuk
- Digunakan untuk mencatat barang yang masuk ke gudang
- Data yang diinput meliputi:
  - Barang
  - Jumlah
  - Tanggal masuk
  - Referensi Purchase Order (opsional)
- Terintegrasi dengan:
  - Data barang
  - Purchase Order
- Setiap transaksi stok masuk akan **menambah jumlah stok secara otomatis**

### Stok Keluar
- Digunakan untuk mencatat barang yang keluar dari gudang
- Data yang diinput meliputi:
  - Barang
  - Jumlah keluar
  - Tujuan atau keterangan pengeluaran
- Terhubung dengan modul Logistik
- Setiap transaksi stok keluar akan **mengurangi stok secara otomatis**

---

## 🛒 Modul Procurement

Modul Procurement mengelola proses pengadaan barang dari pemasok.

### Data Pemasok
- Mengelola master data supplier
- Informasi yang disimpan meliputi:
  - Nama pemasok
  - Alamat
  - Kontak
- Modul ini berdiri sendiri dan menjadi referensi utama untuk Purchase Order

### Purchase Order (PO)
- Digunakan untuk membuat dokumen pemesanan barang ke pemasok
- Data yang diinput:
  - Supplier
  - Tanggal PO
  - Daftar barang
  - Quantity dan harga satuan
- Terintegrasi dengan:
  - Data pemasok
  - Data barang
- Purchase Order memiliki status (misalnya: draft, diproses, selesai)
- PO yang selesai akan menjadi referensi untuk transaksi stok masuk

### Riwayat Purchase Order
- Menampilkan seluruh PO yang pernah dibuat
- Data ditampilkan berdasarkan status PO
- Tidak menerima input manual
- Digunakan untuk monitoring dan evaluasi proses pengadaan

---

## 🏭 Modul Warehouse

Modul Warehouse berfokus pada aktivitas gudang dan histori pergerakan barang.

### Pergerakan Stok
- Mencatat seluruh aktivitas keluar dan masuk barang
- Data berasal dari modul Inventory
- Digunakan sebagai log mutasi stok
- Memudahkan tracking histori pergerakan barang

### Laporan Stok
- Menyajikan laporan kondisi stok barang
- Data diambil dari tabel mutasi stok
- Tidak menerima input manual
- Digunakan untuk kontrol persediaan dan pengambilan keputusan

---

## 🚚 Modul Logistik

Modul Logistik menangani proses distribusi barang dari gudang ke tujuan.

### Daftar Pengiriman
- Digunakan untuk mencatat pengiriman barang
- Data yang diinput:
  - Barang
  - Jumlah
  - Tujuan pengiriman
- Terintegrasi langsung dengan Inventory
- Setiap pengiriman akan memicu transaksi stok keluar

### Tracking Pengiriman
- Digunakan untuk memperbarui status pengiriman
- Contoh status:
  - Diproses
  - Dalam Pengiriman
  - Diterima
- Data diambil dari tabel pengiriman
- Update status dilakukan tanpa membuat data baru

### Riwayat Distribusi
- Menampilkan histori seluruh aktivitas pengiriman
- Tidak menerima input manual
- Digunakan sebagai bahan monitoring dan audit distribusi

---

## 🔗 Konsep Integrasi Data

Beberapa prinsip utama yang diterapkan dalam sistem ini:

- ❌ Tidak ada input stok secara manual
- ✔ Stok dihitung berdasarkan transaksi
- ✔ Modul saling terhubung dan bergantung satu sama lain
- ✔ Mengurangi risiko data ganda dan kesalahan input
- ✔ Merepresentasikan alur SCM dunia nyata pada usaha konveksi

👥 Contributors
Project ini dikembangkan secara kolaboratif oleh:
- [**Tegar Satria**](https://github.com/TegarSa)
- [**Satria Alukman**](https://github.com/SatriaAlukman)
