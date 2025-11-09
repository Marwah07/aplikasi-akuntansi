<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar COA - Akuntansi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 30px;
            background: #eaeaea;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="index.php">Akuntansi</a>
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

    <!-- main content -->
    <div class="container">
        <h2 class="text-center my-5">Daftar Chart of Accounts (COA)</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Jenis Akun</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = new mysqli('localhost', 'root', '', 'aplikasiakuntansi');
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $query = "SELECT kode_coa, nama_coa, jenis, saldo FROM coa";
                $result = $connection->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['kode_coa']) . "</td>
                                <td>" . htmlspecialchars($row['nama_coa']) . "</td>
                                <td>" . htmlspecialchars($row['jenis']) . "</td>
                                <td>" . htmlspecialchars($row['saldo']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }

                $connection->close();
                ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="laporan_labarugi.php" class="btn btn-success">Generate Laporan Laba Rugi</a>
            <a href="laporan_neraca.php" class="btn btn-info">Generate Laporan Neraca</a>
            <a href="dashboard.php" class="btn btn-secondary">Back</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




