<!DOCTYPE html> 
<html>
<head>
    <title>Pemrograman</title>
    <!-- Add Bootstrap 5 CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
//     document.getElementById('level').addEventListener('change', function () {
//         var level = this.value;
//         var diskonMember = 0;

//         switch (level) {
//             case 'Gold':
//                 diskonMember = 5;
//                 break;
//             case 'Silver':
//                 diskonMember = 10;
//                 break;
//             case 'Platinum':
//                 // Jika Platinum dipilih, Anda dapat menetapkan nilai diskon yang sesuai.
//                 diskonMember = 15;
//                 break;
//             default:
//                 // Pilihan default atau jika tidak ada yang dipilih.
//                 diskonMember = 0;
//         }

//         // Kirim nilai diskonMember ke database atau tempat penyimpanan data yang sesuai.
//         // Misalnya, Anda dapat mengirimkan nilai ini melalui AJAX ke server atau menggunakan formulir untuk mengirimkan data.

//         // Contoh AJAX menggunakan jQuery:
//         $.ajax({
//              type: 'POST',
//              url: 'proses.php', // Gantilah dengan URL tujuan Anda.
//              data: { diskonMember: diskonMember },
//              success: function(response) {
//                  console.log('Data berhasil dikirim ke server.');
//              },
//              error: function(error) {
//                  console.error('Gagal mengirim data ke server.');
//              }
//          });
//     });
// </script>

</head>
<body>
    <div class="container mt-4">
        <br/>
        <a class="btn btn-secondary mb-3" href="tampil_member.php">KEMBALI</a>
        <h3>TAMBAH DATA PELANGGAN</h3>
        <?php
            // Koneksi ke database
            include 'koneksi.php';

            // Menangkap data yang dikirim dari form
            if (isset($_POST["save"])) {
                $kode_pelanggan = $_POST["kode_pelanggan"];
                $nama_pelanggan = $_POST["nama_pelanggan"];
                $level = $_POST["level"];

                // // Mendapatkan nomor terakhir dari database atau penyimpanan lokal
                // $queryLastNumber = "SELECT MAX(CAST(SUBSTRING(kode_pelanggan, 3) AS UNSIGNED)) AS last_number FROM t_pelanggAN";
                // $resultLastNumber = mysqli_query($koneksi, $queryLastNumber);
                // $rowLastNumber = mysqli_fetch_assoc($resultLastNumber);
                // $lastNumber = $rowLastNumber['last_number'] ?? 0;

                // // Membuat nomor berikutnya
                // $nextNumber = $lastNumber + 1;
                // $kode_barang = "PL" . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


                // Input data ke database
                $query = "INSERT INTO member (kode_pelanggan, nama_pelanggan, id_level) VALUES ('$kode_pelanggan', '$nama_pelanggan', '$level')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    // Mengalihkan halaman kembali
                    header("location:tampil_member.php");
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="kode_pelanggan" class="form-label">Kode Pelanggan</label>
                <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-select" id="level" name="level" required>
                    <option value="">---PILIH---</option>
                    <?php
                        // Mendapatkan data kode_barang dari database
                        $nama_pelanggan = "SELECT id_level, level FROM level";
                        $resultnamaPelanggan = mysqli_query($koneksi, $nama_pelanggan);

                        // Menampilkan opsi pilihan kode_barang
                        while ($rowNamaPelanggan = mysqli_fetch_assoc($resultnamaPelanggan)) {
                            echo "<option value='" . $rowNamaPelanggan['id_level'] . "'>" . $rowNamaPelanggan['level'] . "</option>";
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
