<?php
session_start();

$detail = [
    "name" => "Grand Atma",
    "tagline" => "Hotel & Resort",
    "page_title" => "Grand Atma Hotel & Resort",
    "logo" => "./assets/images/crown.png"
];
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
    
    <!-- Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="./assets/css/poppins.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <style>
        .form-input{
            margin-left: 350px;
            padding-left: 8px;
            height: 40px;
            width: 700px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        textarea{
            margin-left: 350px;
            padding-left: 8px;
            width: 700px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button, input[type="submit"]{
            object-fit: cover;
            border: none;
            border-radius: 4px;
            background-color: dodgerblue;
            color: white;
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
                <li class="nav-item"><a href="./login.php" class="nav-link text-bg-success">Admin Panel</a></li>
                <li class="nav-item"><a href="./processLogout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main style="padding-top: 84px;" class="container">
        <h1 class="mt-5 mb-3 border-bottom fw-bold">Tambah Kamar</h1>
        <form action="./dashboard.php" method="POST">
            <table cellpadding="6">
                <tr>
                    <td><label for="inputNamaKmr" class="form-label">Nama Kamar</label></td>
                    <td><input type="text" class="form-input" id="inputNamaKmr" name="namaKamar" required></td>
                </tr>
                <tr>
                    <td><label for="inputDesc" class="form-label">Deskripsi</label></td>
                    <td><textarea name="deskripsi" id="inputDesc" cols="60" rows="3" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="inputTipeKmr" class="form-label">Tipe Kamar</label></td>
                    <td>
                        <select name="tipeKamar" id="inputTipeKmr" class="form-input" required>
                            <option value="">Pilih Tipe Kamar</option>
                            <option value="Standard">Standard</option>
                            <option value="Superior">Superior</option>
                            <option value="Luxury">Luxury</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="inputHarga" class="form-label">Harga Kamar (Rp)</label></td>
                    <td><input type="number" class="form-input" id="inputHarga" name="hargaKamar" required></td>
                </tr>

                <td>
                    <button type="submit" id="simpan" name="simpan" value="Simpan">
                        <span class="material-symbols-outlined">
                            save    
                        </span>
                        Simpan
                    </button>
                    <input type="hidden" name="mengisikamar" value="1" />
                </td>
            </table>
        </form>
    </main>
</body>


</html>