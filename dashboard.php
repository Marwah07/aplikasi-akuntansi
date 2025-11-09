<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akuntansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .jumbotron {
            height: 80vh !important;
            display: flex;
            background-size: cover;
            background-position: center;
        }

        .ini {
            overflow: hidden;
            margin: auto;
            color: white;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay effect */
            padding: 20px;
            border-radius: 10px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="#">Akuntansi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Jurnal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="input_transaksi.php">Input Transaksi</a></li>
                            <li><a class="dropdown-item" href="view.php">Daftar Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            COA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="input_coa.php">Input COA</a></li>
                            <li><a class="dropdown-item" href="view_coa.php">Daftar COA</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="buku_besar.php">Buku Besar</a></li>
                            <li><a class="dropdown-item" href="laporan_neraca.php">Neraca</a></li>
                            <li><a class="dropdown-item" href="laporan_labarugi.php">Laba-rugi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->

    <!-- header -->
    <div style="background-image: url('https://images.unsplash.com/photo-1542223616-740d74a1ad73');" class="jumbotron bg-cover">
        <div class="container ini py-5 text-center">
            <h1 class="display-4 font-weight-bold">Kelola Keuangan Anda Bersama Kami</h1>
            <p class="font-italic mb-0">Percayakan keamanan dan pengelolaan data keuangan Anda kepada kami.</p>
        </div>
    </div>
    <!-- header -->

    <!-- main content -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4">
                <h2>Jurnal</h2>
                <p>Catat semua transaksi keuangan Anda dengan mudah dan cepat.</p>
                <a href="input_transaksi.php" class="btn btn-primary">Input Transaksi</a>
                <a href="view.php" class="btn btn-secondary">Daftar Transaksi</a>
            </div>
            <div class="col-lg-4">
                <h2>Chart of Accounts (COA)</h2>
                <p>Kelola daftar akun Anda dengan mudah dan terorganisir.</p>
                <a href="input_coa.php" class="btn btn-primary">Input COA</a>
                <a href="view_coa.php" class="btn btn-secondary">Daftar COA</a>
            </div>
            <div class="col-lg-4">
                <h2>Laporan Keuangan</h2>
                <p>Dapatkan laporan keuangan seperti neraca dan laba-rugi dengan cepat.</p>
                <a href="buku_besar.php" class="btn btn-primary">Buku Besar</a>
                <a href="laporan_neraca.php" class="btn btn-secondary">Neraca</a>
                <a href="laporan_labarugi.php" class="btn btn-secondary">Laba-rugi</a>
            </div>
        </div>
    </div>
    <!-- main content -->

    <!-- footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Akuntansi. All rights reserved.</p>
            <p>Contact us: <a href="mailto:info@akuntansi.com">info@akuntansi.com</a></p>
        </div>
    </footer>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
