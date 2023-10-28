<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Penjualan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
//     function getBarangInfo() {
//         var kodeBarang = document.getElementById('kode_barang').value;

//         // Mengirimkan kode barang ke server menggunakan AJAX
//         var xhr = new XMLHttpRequest();
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState == 4 && xhr.status == 200) {
//                 // Menangani respons dari server
//                 document.getElementById('nama_barang').value = xhr.responseText;
//             }
//         };

//         // Mengirim permintaan ke server (get_barang_info.php)
//         xhr.open('POST', 'get_barang_info.php', true);
//         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//         xhr.send('kode_barang=' + kodeBarang);
//     }
// </script>
</head>
<?php
    //koneksi database
    include 'koneksi.php';
    //menangkap data yang dikirim dari form
    if (isset($_POST["save"])) {
        $Tanggal = $_POST['tanggal_penjualan'];
        $Nama = $_POST['nama_pelanggan'];
        $kode_barang =$_POST['kode_barang'];
        $qty =$_POST['qty'];
        //menginput data ke database
        $a = mysqli_query($koneksi,"insert into penjualan values('','$Tanggal','$Nama','$kode_barang','$qty')");
        if($a){
            //mengalihkan ke halaman kembali
            header("location:tampil_penjualan.php");
        }else{
            echo "error". mysqli_error($koneksi);
        }
    }
?>
<body>
    <div class="container mt-4">
        <a href="tampil_penjualan.php" class="btn btn-primary">Kembali</a>
        <h3 class="mt-3">TAMBAH DATA PENJUALAN</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="tanggal_penjualan" class="form-label">Tanggal Penjualan</label>
                <input type="date" name="tanggal_penjualan" class="form-control" id="tanggal_penjualan" required>
            </div>
            <script>
            // Mengisi nilai tanggal secara otomatis
            document.getElementById('tanggal_penjualan').valueAsDate = new Date();
            </script>
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <select class="form-select" id="nama_pelanggan" name="nama_pelanggan" required>
                    <option value="">---PILIH---</option>
                    <?php
                        // Mendapatkan data kode_barang dari database
                        $nama_pelanggan = "SELECT nama_pelanggan FROM member";
                        $resultnamaPelanggan = mysqli_query($koneksi, $nama_pelanggan);

                        // Menampilkan opsi pilihan kode_barang
                        while ($rowNamaPelanggan = mysqli_fetch_assoc($resultnamaPelanggan)) {
                            echo "<option value='" . $rowNamaPelanggan['nama_pelanggan'] . "'>" . $rowNamaPelanggan['nama_pelanggan'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <select class="form-select" id="kode_barang" name="kode_barang" required>
                    <option value="">---PILIH---</option>
                    <?php
                        // Mendapatkan data kode_barang dari database
                        $kodeBarang = "SELECT kode_barang, nama_barang FROM barang";
                        $resultKodeBarang = mysqli_query($koneksi, $kodeBarang);

                        // Menampilkan opsi pilihan kode_barang
                        while ($rowKodeBarang = mysqli_fetch_assoc($resultKodeBarang)) {
                            echo "<option value='" . $rowKodeBarang['kode_barang'] . "'>" . $rowKodeBarang['kode_barang'] . "</option>";                        }
                        ?>
                </select>
            </div>
            <!-- <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" id="nama_barang" readonly>
                
                
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" id="harga" value="" readonly>    
            </div> -->
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" name="qty" class="form-control" id="qty" required>
            </div>
            <button type="submit" name="save" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</body>
</html>
