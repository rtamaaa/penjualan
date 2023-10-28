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
        <a class="btn btn-secondary mb-3" href="tampil_trans.php">KEMBALI</a>
        <h3>TAMBAH TRANSAKSI</h3>
        <?php
            // Koneksi ke database
            include 'koneksi.php';

            // Menangkap data yang dikirim dari form
            if (isset($_POST["save"])) {
                $tgl_transaksi = $_POST["tgl_transaksi"];
                $no_transaksi = $_POST["no_transaksi"];
                $jenis_transaksi = $_POST["jenis_transaksi"];
                $kode_barang = $_POST["kode_barang"];
                $jml_barang = $_POST["jml_barang"];

                // Query untuk mendapatkan nilai diskon dari database
                $queryDiskon = "SELECT diskon FROM kategori WHERE kode_barang = '$kode_barang'";
                $resultDiskon = mysqli_query($koneksi, $queryDiskon);

                // Mengecek apakah query diskon berhasil dieksekusi
                if ($resultDiskon) {
                    // Mengambil nilai diskon dari hasil query
                    $rowDiskon = mysqli_fetch_assoc($resultDiskon);
                    $diskon = $rowDiskon['diskon'];

                    // Menghitung nilai diskon
                    $nilai_diskon = ($diskon / 100) * $jml_barang;
                } else {
                    // Menampilkan pesan kesalahan jika query diskon tidak berhasil dieksekusi
                    echo "Error fetching discount: " . mysqli_error($koneksi);
                }



                $queryInsert = "INSERT INTO transaksi (tgl_transaksi, no_transaksi, jenis_transaksi, kode_barang, jml_barang) 
                        VALUES ('$tgl_transaksi', '$no_transaksi', '$jenis_transaksi', '$kode_barang', '$jml_barang')";
                $resultInsert = mysqli_query($koneksi, $queryInsert); 

                if ($resultInsert) {
                 // Update stok barang
                 $queryUpdateStok = "UPDATE barang SET qty = qty - $jml_barang WHERE kode_barang = '$kode_barang'";
                 $resultUpdateStok = mysqli_query($koneksi, $queryUpdateStok);

                   if ($resultUpdateStok) {
                     // Mengalihkan halaman kembali
                         header("location:tampil_trans.php");
                     } else {
                         echo "Error updating stock: " . mysqli_error($koneksi);
                     }
                     } else {
                     echo "Error inserting transaction: " . mysqli_error($koneksi);
                 }
            }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="tgl_transaksi" class="form-label">Tanggal transaksi</label></label>
                <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
            </div>
            <script>
            // Mengisi nilai tanggal secara otomatis
            document.getElementById('tgl_transaksi').valueAsDate = new Date();
            </script>
            <div class="mb-3">
                <label for="no_transaksi" class="form-label">no_transaksi</label>
                <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
            </div>
            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Jenis Trnsaksi</label>
                <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                    <option value="">---PILIH---</option>
                    <option value="Member">Member</option>
                    <option value="Non-member">Non-member</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <select class="form-select" id="kode_barang" name="kode_barang" required>
                    <option value="">---PILIH---</option>
                    <?php
                        // Mendapatkan data kode_barang dari database
                        $Kode_Barang = "SELECT kode_barang FROM barang";
                        $resultKodeBarang = mysqli_query($koneksi, $Kode_Barang);

                        // Menampilkan opsi pilihan kode_barang
                        while ($rowKodeBarang = mysqli_fetch_assoc($resultKodeBarang)) {
                            echo "<option value='" . $rowKodeBarang['kode_barang'] . "'>" . $rowKodeBarang['kode_barang'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jml_barang" class="form-label">Jumlah Barang</label>
                <input type="number" class="form-control" id="jml_barang" name="jml_barang" required min="1">
            </div>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    
    <!-- Add Bootstrap 5 JS and Popper.js (for Bootstrap dropdowns, tooltips, and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
</body>
</html>
