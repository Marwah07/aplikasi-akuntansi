<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplikasi Penjurnalan - Laporan Laba Rugi</title>
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
    .table {
      margin-bottom: 0;
    }
    .table thead th {
      border-bottom: 2px solid #dee2e6;
    }
    .table tbody tr:last-child td {
      border-top: 2px solid #dee2e6;
    }
  </style>
</head>
<body>
  <?php
  $connection = mysqli_connect('localhost', 'root', '', 'aplikasiakuntansi');

  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  function getTotal($connection, $jenis) {
    $query = "SELECT nama_coa, SUM(saldo) AS total FROM coa WHERE jenis = ? AND saldo > 0 GROUP BY nama_coa";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $jenis);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $total = 0;

    if ($jenis === 'Pendapatan') {
      echo "<tr class='table-primary'><td colspan='2' class='bold-label'>$jenis</td><td></td></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . htmlspecialchars($row['nama_coa']) . "</td><td class='text-right'>" . number_format($row['total'], 2, ',', '.') . "</td><td></td></tr>";
        $total += $row['total'];
      }
    } else if ($jenis === 'Beban Pengeluaran') {
      echo "<tr class='table-danger'><td colspan='2' class='bold-label'>$jenis</td><td></td></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . htmlspecialchars($row['nama_coa']) . "</td><td></td><td class='text-right'>" . number_format($row['total'], 2, ',', '.') . "</td></tr>";
        $total += $row['total'];
      }
    }

    return $total;
  }
  ?>
  
  <div class="container bg-white shadow-lg rounded-lg p-5">
    <div class="text-center mb-4">
      <h2>Laporan Laba Rugi</h2>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Keterangan</th>
          <th class="text-right">Debet</th>
          <th class="text-right">Kredit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_pemasukan = getTotal($connection, 'Pendapatan');
        $total_pengeluaran = getTotal($connection, 'Beban Pengeluaran');
        
        $net_income_before_tax = $total_pemasukan - $total_pengeluaran;

        // Menambahkan pernyataan SQL untuk melakukan update pada tabel coa
        $update_query = "UPDATE coa SET saldo = ? WHERE nama_coa = 'Laba/Rugi Sebelum Pajak'";
        $stmt = mysqli_prepare($connection, $update_query);
        mysqli_stmt_bind_param($stmt, "d", $net_income_before_tax);
        mysqli_stmt_execute($stmt);

        echo "<tr class='table-primary'><td><b>Total Pendapatan</b></td><td class='text-right'><b>" . number_format($total_pemasukan, 2, ',', '.') . "</b></td><td></td></tr>";
        echo "<tr class='table-danger'><td><b>Total Beban</b></td><td></td><td class='text-right'><b>" . number_format($total_pengeluaran, 2, ',', '.') . "</b></td></tr>";
        echo "<tr class='table-success'><td><b>Laba/Rugi Sebelum Pajak</b></td><td></td><td class='text-right'><b>" . number_format($net_income_before_tax, 2, ',', '.') . "</b></td></tr>";
        ?>
      </tbody>
    </table>
    
    <div class="text-right mt-3">
      <!-- Print button -->
      <button class="btn btn-success px-3 rounded-pill shadow-lg" onclick="printReport()">Cetak</button>
      <!-- Kembali button -->
      <a href="dashboard.php" class="btn btn-primary px-3 rounded-pill shadow-lg">Kembali</a>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js CDN links -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- JavaScript for printing -->
  <script>
    function printReport() {
      window.print();
    }
  </script>

  <?php
  mysqli_close($connection);
  ?>
</body>
</html>



