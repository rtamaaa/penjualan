<!DOCTYPE html> 
<html>
<head>
    <title>Pemrograman 3 - View Transaksi</title>
    <!-- Add Bootstrap 5 CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <a class="btn btn-primary" href="tambah_trans.php">+ TAMBAH TRANSAKSI</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Tanggal Transaksi</th>
                    <th>No Transaksi</th>
                    <th>Jenis Transaksi</th>
                    <th>Kode Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Diskon</th>
                    <th>OPSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.diskon 
                                                FROM transaksi 
                                                JOIN kategori ON transaksi.kode_barang = kategori.kode_barang");
                while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['tgl_transaksi']; ?></td>
                        <td><?php echo $d['no_transaksi']; ?></td>
                        <td><?php echo $d['jenis_transaksi']; ?></td>
                        <td><?php echo $d['kode_barang']; ?></td>
                        <td><?php echo $d['jml_barang']; ?></td>
                        <td><?php echo $d['diskon']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="edit_trans.php?id=<?php echo $d['id_transaksi']; ?>">EDIT</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $d['id_transaksi']; ?>">
                                Hapus
                            </button>
                        </td>
                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="hapusModal<?php echo $d['id_transaksi']; ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <!-- Tombol Hapus di dalam Modal -->
                                        <a href="?id=<?php echo $d['id_transaksi']; ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Add Bootstrap 5 JS and Popper.js (for Bootstrap dropdowns, tooltips, and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
</body>
</html>
