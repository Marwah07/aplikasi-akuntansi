<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Penjurnalan - Menu Laporan</title>
  <!-- Bootstrap CSS CDN link -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 30px;
      background: #eaeaea;
    }
    .bold-label {
      font-weight: bold;
    }
    .container {
      background-color: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .jumbotron {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1542223616-740d74a1ad73') no-repeat center center;
      background-size: cover;
      height: 200px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 15px;
    }
    .jumbotron h2 {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container bg-white rounded-lg p-5 shadow-lg">
    <div class="jumbotron mb-4">
      <h2>Buku Besar</h2>
    </div>
    <?php
    if (isset($_GET['selectedAccount']) && !empty($_GET['selectedAccount'])) {
        echo '<h4>' . $_GET['selectedAccount'] . '</h4>';
    }
    ?>

    <form method="GET">
      <div class="form-group">
        <label for="selectAkun" class="bold-label">Pilih Akun:</label>
        <select class="form-control" id="selectAkun" name="selectedAccount">
          <option value="">Pilih Akun</option>
          <?php
          $connection = mysqli_connect('localhost', 'root', '', 'aplikasiakuntansi');
          if ($connection->connect_error) {
              die("Connection failed: " . $connection->connect_error);
          }
          
          // Query untuk mendapatkan daftar akun yang tersedia
          $query_akun = "SELECT DISTINCT akun_debet AS akun FROM table_transaksi UNION SELECT DISTINCT akun_kredit AS akun FROM table_transaksi";
          $result_akun = mysqli_query($connection, $query_akun);
          while ($row_akun = mysqli_fetch_assoc($result_akun)) {
              echo "<option value='" . $row_akun['akun'] . "'>" . $row_akun['akun'] . "</option>";
          }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary rounded-pill px-3 shadow-lg">Tampilkan</button>
    </form>
    
    <?php
    if (isset($_GET['selectedAccount']) && !empty($_GET['selectedAccount'])) {
        $selectedAccount = $_GET['selectedAccount'];
        $query_buku_besar = "SELECT tanggal, nama_transaksi, 
                                    CASE WHEN akun_debet = '$selectedAccount' THEN nominal ELSE 0 END AS debet,
                                    CASE WHEN akun_kredit = '$selectedAccount' THEN nominal ELSE 0 END AS kredit
                                    FROM table_transaksi
                                    WHERE akun_debet = '$selectedAccount' OR akun_kredit = '$selectedAccount'";
        $result_buku_besar = mysqli_query($connection, $query_buku_besar);

        echo '<table class="table table-bordered mt-4">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Debet</th>
                    <th scope="col">Kredit</th>
                    <th scope="col">Saldo</th>
                  </tr>
                </thead>
                <tbody>';

        $saldo = 0;
        while ($row_buku_besar = mysqli_fetch_assoc($result_buku_besar)) {
            $saldo += $row_buku_besar['debet'] - $row_buku_besar['kredit'];
            $saldo_positif = abs($saldo); // Menggunakan nilai absolut dari saldo

            echo "<tr>";
            echo "<td>" . date('d-m-Y', strtotime($row_buku_besar['tanggal'])) . "</td>";
            echo "<td>" . $row_buku_besar['nama_transaksi'] . "</td>";
            echo "<td>" . number_format($row_buku_besar['debet'], 2, ',', '.') . "</td>";
            echo "<td>" . number_format($row_buku_besar['kredit'], 2, ',', '.') . "</td>";
            echo "<td>" . number_format($saldo_positif, 2, ',', '.') . "</td>"; // Menampilkan saldo positif
            echo "</tr>";
        }

        echo '</tbody></table>';
    }
    ?>

    <!-- Kembali button -->
    <div class="text-right mb-2">
      <a href="dashboard.php" class="btn btn-primary rounded-pill px-3 shadow-lg">Kembali</a>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js CDN links -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($connection)) {
    mysqli_close($connection);
}
?>

