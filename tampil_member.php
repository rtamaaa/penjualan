<head>
    <title>Pemrograman 3</title>
    <!-- Add Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <a class="btn btn-primary" href="tambah_member.php">+ PELANGGAN</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                session_start();

                if (!isset($_SESSION['level']) || ($_SESSION['level'] !== "admin" && $_SESSION['level'] !== "staff")) {
                    // Jika tidak login atau level bukan admin atau staff, redirect ke halaman logout
                    header("location: logout.php");
                    exit();
                }

                $no = 1;
                $data = mysqli_query($koneksi, "select * from member");
                while ($d = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['kode_pelanggan']; ?></td>
                        <td><?php echo $d['nama_pelanggan']; ?></td>
                        <td><?php echo $d['id_level']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo $d['id_user']; ?>">EDIT</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $d['id_user']; ?>">
                                Hapus
                            </button>
                        </td>
                    
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