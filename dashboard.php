<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ./login.php");
    exit;
}

$detail = [
    "name" => "Grand Atma",
    "tagline" => "Hotel & Resort",
    "page_title" => "Admin Panel - Grand Atma Hotel & Resort",
    "logo" => "./assets/images/crown.png" 
];

//init daftar kamar
$_SESSION["DaftarKamar"] = [];

// tambah kamar
if(isset($_POST["mengisikamar"])) {

    $namaKamar = $_POST["namaKamar"];
    $deskripsi = $_POST["deskripsi"];
    $tipeKamar = $_POST["tipeKamar"];
    $hargaKamar = $_POST["hargaKamar"];

    $daftarKamar = [
            "namaKamar" => $namaKamar ,
            "deskripsi" => $deskripsi ,
            "tipeKamar" => $tipeKamar ,
            "hargaKamar" => $hargaKamar
    ];
    $_SESSION["DaftarKamar"][] = $daftarKamar;

    $_SESSION["berhasil"] = "Berhasil menyimpan data kamar $namaKamar";

}

// hapus kamar
if(isset($_POST["deleteKamar"])) {

    $index = $_POST['index'];
    $namaKamar = $_SESSION['DaftarKamar'][$index]["namaKamar"];

    unset($_SESSION['DaftarKamar'][$index]);

    $_SESSION["hapus"] = "Berhasil menghapus data kamar $namaKamar";

}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo $detail["page_title"]; ?></title> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Icon tab -->
    <link rel="icon" href="<?php echo $detail["logo"]; ?>" type="image/x-icon" />
    
    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="./assets/css/poppins.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <style>
        .img-bukti-ngantor {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover:
        }

        .linkKamar{
            background-color: green;
            border: none;
            border-radius: 5px;
            padding: 3px 3px 3px;
            text-decoration: none;
            color: white;
            font-size: 18px;
            
        }

        a:hover{
            text-decoration: none;
            color: white;
        }

        .featurette-image{
            height: 200px;
            width: 300px;
        }

        .btnDelete{
           background-color: crimson;
           color: white;
           border: none;
           border-radius: 5px;
        }
    </style>
</head>

<body>
    <header class="fixed-top" id="navbar">
        <nav class="container nav-top py-2">
            <a href="./" class="rounded bg-white py-2 px-3 d-flex align-items-center nav-home-btn"> 
                <img src="<?php echo $detail["logo"]; ?>" class="crown-logo" />
                <div>
                    <p class="mb-0 fs-5 fw-bold"><?php echo $detail["name"]; ?></p>
                    <p class="small mb-0"><?php echo $detail["tagline"]; ?></p>
                </div>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="./" class="nav-link">Home</a></li> 
                <li class="nav-item"><a href="#" class="nav-link active"  aria-current="page">Admin Panel</a></li>
                <li class="nav-item"><a href="./processLogout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main style="padding-top: 84px;" class="container">
        <h1 class="mt-5 mb-3 border-bottom fw-bold">Dashboard</h1>
        
        <!-- Berhasil tambah kamar -->
        <?php if (isset($_SESSION["berhasil"])) { ?>
                <div class="alert alert-success mb-4 text-center" role="alert"> 
                    <strong>Berhasil!</strong> <?php echo $_SESSION["berhasil"]; ?>
                </div>
            <?php
                unset($_SESSION["berhasil"]);
            } ?>

        <!-- hapus kamar -->
        <?php if (isset($_SESSION["hapus"])) { ?>
                <div class="alert alert-success mb-4 text-center" role="alert"> 
                    <strong>Berhasil!</strong> <?php echo $_SESSION["hapus"]; ?>
                </div>
            <?php
                unset($_SESSION["hapus"]);
            } ?>

        <div class="row">
            <div class="col-lg-10">
                <div class="card card-body h-100 justify-content-center">
                    <h4>Selamat datang,</h4> 
                    <h1 class="fw-bold display-6 mb-3"><?php echo $_SESSION["user"]["username"]; ?></h1>
                    
                    <p class="mb-0">Kamu sudah login sejak:</p>
                    <p class="fw-bold lead mb-0"><?php echo $_SESSION["user"]["login_at"]; ?></p>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card card-body">
                    <p>Bukti sedang ngantor: </p>
                    <img
                        src="<?php echo $_SESSION["user"]["bukti_ngantor"]; ?>"
                        class="img-fluid rounded img-bukti-ngantor"
                        alt="Bukti ngantor (sudah dihapus)" />
                </div>
            </div>
        </div>

        <div>
            <h1 class="mt-5 mb-3 border-bottom fw-bold">Daftar Kamar</h1>
            <p class="mb-2">Grand Atma saat ini memiliki <strong><?php echo count($_SESSION["DaftarKamar"]) ?></strong> jenis kamar yang eksotis.</p>
                <a class="linkKamar" href="./formkamar.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Tambah Kamar
                </a>

            <?php if (count($_SESSION["DaftarKamar"]) != 0) { ?>
                <?php foreach ($_SESSION['DaftarKamar'] as $index => $daftarKamar) {?>
                <fieldset class="card card-body h-100 justify-content-center mt-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <img
                                src="./assets/images/featurette-2.jpeg"
                                class="featurette-image"
                                role="img" aria-label="Gambar featurette 2" focusable="false" />
                            
                        </div>

                        <div class="col-lg-8">
                            <h4><?php echo $daftarKamar["namaKamar"]; ?></h4> 
                            <p class="border-bottom"><?php echo $daftarKamar["deskripsi"]?></p>
                            <p>
                                Tipe Kamar: <strong><?php echo $daftarKamar["tipeKamar"]?></strong>
                                Base price: <strong>Rp<?php echo $daftarKamar["hargaKamar"]?></strong>
                            </p>
                            <div>
                                <form  method="POST" action="./dashboard.php">
                                <button name="deleteKmr" class="btnDelete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                    Hapus
                                </button>
                                <input type="hidden" name="index" value="<?php echo $index ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php } ?>
            <?php
            } ?>
        </div>
    </main>

    <!-- Bootstrap 5.3 JS -->
    <script scr="./assets/js/bootstrap.min.js"></script>
</body>


</html>

