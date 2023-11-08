
<!DOCTYPE html> 
<html>
<head>
    <title>Pemrograman</title>
    <!-- Add Bootstrap 5 CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <br/>
        <a class="btn btn-secondary mb-3" href="tampil_barang.php">KEMBALI</a>
        <h3>TAMBAH DATA BARANG</h3>
        <?php
            // Koneksi ke database
            include 'koneksi.php';

            session_start();

                if (!isset($_SESSION['level']) || ($_SESSION['level'] !== "admin" && $_SESSION['level'] !== "staff")) {
                    // Jika tidak login atau level bukan admin atau staff, redirect ke halaman logout
                    header("location: logout.php");
                    exit();
                }
            // Menangkap data yang dikirim dari form
            if (isset($_POST["save"])) {
                $kode_barang = $_POST["kode_barang"];
                $nama_barang = $_POST["nama_barang"];
                $harga = $_POST["harga"];
                $qty = $_POST["qty"];
                $id_kategori = $_POST["id_kategori"];

                // // Mendapatkan nomor terakhir dari database atau penyimpanan lokal
                // $queryLastNumber = "SELECT MAX(CAST(SUBSTRING(kode_pelanggan, 3) AS UNSIGNED)) AS last_number FROM t_pelanggAN";
                // $resultLastNumber = mysqli_query($koneksi, $queryLastNumber);
                // $rowLastNumber = mysqli_fetch_assoc($resultLastNumber);
                // $lastNumber = $rowLastNumber['last_number'] ?? 0;

                // // Membuat nomor berikutnya
                // $nextNumber = $lastNumber + 1;
                // $kode_barang = "PL" . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


                // Input data ke database
                $query = "INSERT INTO barang (kode_barang, nama_barang, harga, qty, id_kategori) VALUES ('$kode_barang', '$nama_barang', '$harga', '$qty', '$id_kategori')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    // Mengalihkan halaman kembali
                    header("location:tampil_barang.php");
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" class="form-control" id="qty" name="qty" required>
            </div>
            <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select class="form-select" id="id_kategori" name="id_kategori" required>
                    <option value="">---PILIH---</option>
                    <?php
                        // Mendapatkan data kategori dari database
                        $queryKategori = "SELECT id_kategori, nama_kategori FROM kategori";
                        $resultKategori = mysqli_query($koneksi, $queryKategori);

                        // Menampilkan opsi pilihan kategori
                        while ($rowKategori = mysqli_fetch_assoc($resultKategori)) {
                            echo "<option value='" . $rowKategori['id_kategori'] . "'>" . $rowKategori['nama_kategori'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    
    <!-- Add Bootstrap 5 JS and Popper.js (for Bootstrap dropdowns, tooltips, and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script>
    // // Fungsi untuk mengisi nilai kode_pelanggan secara otomatis
    // function generatePelangganCode() {
    //     // Mendapatkan nomor terakhir dari database atau penyimpanan lokal
    //     let lastNumber = <?php echo $lastNumber ?? 0; ?>;

    //     // Membuat nomor berikutnya
    //     let nextNumber = lastNumber + 1;
    //     let kode_pelanggan = "PL" + nextNumber.toString().padStart(4, '0');

    //     // Mengisi nilai kode_pelanggan ke dalam input
    //     document.getElementById('kode_pelanggan').value = kode_pelanggan;
    // }

    // Memanggil fungsi untuk mengisi nilai kode_pelanggan saat halaman dimuat
    generatePelangganCode();
</script>

</body>
</html>
