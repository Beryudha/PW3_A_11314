<?php
session_start();

// Kalau user sudah login, arahkan ke halaman dashboard
if (isset($_SESSION["user"])) {
    header("Location: ./dashboard.php");
    exit;
}

// Kalau ada $_POST["mencoba_login"], artinya user sudah mengirimkan data login
if(isset($_POST["mencoba_login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek apakah username dan password sudah diisi
    if (empty($username) || empty($password)) {
        // Kalau belum, set error ke session agar bisa ditampilkan di halaman login 
        $_SESSION["error"] = "Username dan password harus diisi!";

        // Redirect kembali ke halaman login 
        header("Location: ./login.php");
        exit;
    }

    // Proses bukti sedang ngantor
    if (!isset($_FILES["bukti_ngantor"])) {
        $_SESSION["error"] = "Bukti sedang ngantor harus diisi!";
        header("Location: ./login.php");
        exit;
    }

    // Get file dari $_FILES
    $buktiNgantor = $_FILES['bukti_ngantor'];
    $tmpfile = $buktiNgantor["tmp_name"];

    $folderTujuan = "./bukti_ngantor/";
    $namaFile = $buktiNgantor["name"];
    $alamatFile = $folderTujuan . $alamatFile;

    // Upload file ke folder tujuan
    if (!move_uploaded_file($tmpfile, $alamatFile)) {
        $_SESSION["error"] = "Gagal mengupload bukti sedang ngantor!";
        header("Location: ./login.php");
        exit;
    }

    // Selesai, set session user dan redirect ke halaman dashboard
    $_SESSION["user"] = [
        "username" => $username,
        "password" => $password,
        "bukti_ngantor" => $alamatFile,
        // Tambahkan waktu login menggunakan fungsi date()
        "login_at" => date("Y-m-d H:i:s")
    ];
    header("Location: ./dashboard.php");
}

