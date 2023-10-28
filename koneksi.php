<?php
$koneksi = mysqli_connect("localhost","root","","db_penjualan");

// Check Connection
if (mysqli_connect_error()){
    echo "Koneksi database gagal : " . mysqli_connect_error();

}

?>