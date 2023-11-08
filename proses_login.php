<?php
                        session_start();

                        // Check if the user is already logged in, redirect to home if true
                        if (isset($_SESSION['nama'])) {
                            header("location: index.php");
                            exit();
                        }

                        // Include database connection
                        include 'koneksi.php';

                        // Handle form submission
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $Nama = $_POST["nama"];
                            $password = $_POST["password"];

                            // Use prepared statement to prevent SQL injection
                            $query = "SELECT * FROM user WHERE nama=?";
                            $stmt = mysqli_prepare($koneksi, $query);
                            mysqli_stmt_bind_param($stmt, "s", $Nama);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            // Check if the query was successful
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                
                             //  $m = $row && password_verify($password, $row['password']); // password hash
                               
                               $md = $row && md5($password) === $row['password']; //md5
                              // var_dump($md);

                                if ($md) {
                                    // Set session variables
                                    $_SESSION['nama'] = $Nama;
                                    $_SESSION['level'] = $row['level'];

                                    // Redirect based on user level
                                    if ($_SESSION['level'] == 'admin') {
                                
                                        header("location: dashboard_admin.php");

                                    }else if ($_SESSION['level'] == 'staff') {
                                         header("location: dashboard_staff.php");
                                    }
                                     else {
                                        echo '<div class="alert alert-danger" role="alert">Kamu belum terdaftar, silahkan mendaftar dengan menghubungi pihak Admin.</div>';
                                    }
                                    exit();
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Login failed. Please check your Nama and password.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($koneksi) . '</div>';
                            }
                        }


                        ?>