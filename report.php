<?php
session_start();

if (!isset($_SESSION['level']) || ($_SESSION['level'] !== "admin" && $_SESSION['level'] !== "staff")) {
    // Jika tidak login atau level bukan admin atau staff, redirect ke halaman logout
    header("location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pemprograman 3</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Pemprograman 3 2023</h2>
        <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
        <h5>Laporan Transaksi</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Level</th>
                    <th>Diskon Member</th>
                    <th>Barang</th>
                    <th>Jenis Barang</th>
                    <th>Diskon Barang</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Total Pembelian</th>
                    <th>Diskon Belanja</th>
                    <th>Total Diskon</th>
                    <th>Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                $data = mysqli_query($koneksi, "SELECT M.nama_pelanggan, L.level, L.diskon_level, K.diskon, K.nama_kategori, B.harga, B.nama_barang, P.qty 
                FROM penjualan P 
                JOIN barang B ON P.kode_barang = B.kode_barang 
                JOIN kategori K ON B.id_kategori = K.id_kategori
                JOIN member M ON P.nama_pelanggan = M.nama_pelanggan 
                JOIN level L ON M.id_level = L.id_level 
                ");

                while ($d = mysqli_fetch_array($data)) { 
                    $totalHarga = $d['harga'] * $d['qty'];

                    if ($totalHarga > 100000) {
                        $diskonBelanja = 10;
                    } else {
                        $diskonBelanja = 0;
                    }
                    $totalDiskon = $totalHarga * (($diskonBelanja + $d['diskon_level'] + $d['diskon']) / 100);
                    $totalTransaksi = $totalHarga - $totalDiskon;
                ?>
                    <tr>
                        <td><?= $d['nama_pelanggan']; ?></td>
                        <td><?= $d['level']; ?></td>
                        <td><?= $d['diskon_level'] . '%'; ?></td>
                        <td><?= $d['nama_barang']; ?></td>
                        <td><?= $d['nama_kategori']; ?></td>
                        <td><?= $d['diskon'] . '%'; ?></td>
                        <td><?= $d['harga']; ?></td>
                        <td><?= $d['qty']; ?></td>
                        <td><?= $totalHarga; ?></td>
                        <td><?= $diskonBelanja . '%'; ?></td>
                        <td><?= $totalDiskon; ?></td>
                        <td><?= $totalTransaksi; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS (if needed) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>
