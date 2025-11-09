<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input COA - Akuntansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .form-container {
            margin-top: 50px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="dashboard.php">Akuntansi</a>
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
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->

    <!-- main content -->
    <div class="container form-container">
        <h2 class="text-center">Input Chart of Accounts (COA)</h2>
        <form action="input_coa.php" method="post">
            <div class="mb-3">
                <label for="kode_coa" class="form-label">Kode Akun</label>
                <input type="text" class="form-control" id="kode_coa" name="kode_coa" required>
            </div>
            <div class="mb-3">
                <label for="nama_coa" class="form-label">Nama Akun</label>
                <input type="text" class="form-control" id="nama_coa" name="nama_coa" required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Akun</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option value="">Pilih Jenis Akun</option>
                    <option value="Aktiva">Aktiva</option>
                    <option value="Pasiva">Pasiva</option>
                    <option value="Modal">Modal</option>
                    <option value="Pendapatan">Pendapatan</option>
                    <option value="Beban Pengeluaran">Beban Pengeluaran</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo Awal</label>
                <input type="number" class="form-control" id="saldo" name="saldo" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <!-- main content -->

    <!-- footer -->
    <footer class="mt-5">
        <div class="container">
            <p>&copy; 2024 Akuntansi. All rights reserved.</p>
            <p>Contact us: <a href="mailto:info@akuntansi.com">info@akuntansi.com</a></p>
        </div>
    </footer>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = mysqli_connect('localhost', 'root', '', 'aplikasiakuntansi');

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $kode_coa = $_POST['kode_coa'];
    $nama_coa = $_POST['nama_coa'];
    $jenis = $_POST['jenis'];
    $saldo = $_POST['saldo'];

    $sql = "INSERT INTO coa (kode_coa, nama_coa, jenis, saldo) VALUES (?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssd", $kode_coa, $nama_coa, $jenis, $saldo);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $connection->close();
}
?>

