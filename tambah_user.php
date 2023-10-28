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
        <a class="btn btn-secondary mb-3" href="index.php">KEMBALI</a>
        <h3>TAMBAH DATA USER</h3>
        <?php
            // Koneksi ke database
            include 'koneksi.php';

            // Menangkap data yang dikirim dari form
            if (isset($_POST["save"])) {
                $Nama = $_POST["Nama"];
                $Password = $_POST["Password"];
                $Level = $_POST["level"];
                $Status = $_POST["status"];

                // Input data ke database
                $query = "INSERT INTO user (Nama, Password, level, status) VALUES ('$Nama', '$Password', '$Level', '$Status')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    // Mengalihkan halaman kembali
                    header("location:tampil_user.php");
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="Nama" name="Nama" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-select" id="level" name="level" required>
                    <option value="">---PILIH---</option>
                    <option value="1">Admin</option>
                    <option value="2">Staff</option>
                    <option value="3">Spv</option>
                    <option value="4">Mgr</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">---PILIH---</option>
                    <option value="1">Aktif</option>
                    <option value="2">Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    
    <!-- Add Bootstrap 5 JS and Popper.js (for Bootstrap dropdowns, tooltips, and popovers) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
</body>
</html>
