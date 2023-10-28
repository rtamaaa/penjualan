<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Fungsi hapus data dari database berdasarkan ID
    function hapusData($koneksi, $id_user) {
        $sql = "DELETE FROM t_user WHERE id_user = $id_user";

        if ($koneksi->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Panggil fungsi hapus data
    if (hapusData($koneksi, $id_user)) {
    } else {
        echo "Error: " . $koneksi->error;
    }
}

?>


<head>
    <title>Pemrograman 3</title>
    <!-- Add Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <a class="btn btn-primary" href="tambah_user.php">+ TAMBAH USER</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>OPSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi, "select * from user");
                while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nama']; ?></td>
                        <td><?php echo $d['password']; ?></td>
                        <td><?php echo $d['level']; ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo $d['id_user']; ?>">EDIT</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $d['id_user']; ?>">
                                Hapus
                            </button>
                        </td>
                        <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="hapusModal<?php echo $d['id_user']; ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                                    <a href="?id=<?php echo $d['id_user']; ?>" class="btn btn-danger">Hapus</a>
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