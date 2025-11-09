<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Penjurnalan - View Transaksi</title>
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
  </style>
</head>
<body>
  <div class="container-sm">
    <div class="text-center">
      <h2>Daftar Transaksi</h2>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Transaksi</th>
            <th scope="col">Akun Debet</th>
            <th scope="col">Akun Kredit</th>
            <th scope="col">Nominal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $connection = mysqli_connect('localhost', 'root', '', 'aplikasiakuntansi');
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
          }
          $query = "SELECT * FROM table_transaksi";
          $result = mysqli_query($connection, $query);
          if (!$result) {
            die("Query failed: " . mysqli_error($connection));
          }
          if (mysqli_num_rows($result) > 0) {
            $index = 1;
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<th scope='row'>$index</th>";
              echo "<td>" . $row['tanggal'] . "</td>";
              echo "<td>" . $row['nama_transaksi'] . "</td>";
              echo "<td>" . $row['akun_debet'] . "</td>";
              echo "<td>" . $row['akun_kredit'] . "</td>";
              echo "<td>" . $row['nominal'] . "</td>";
              echo "</tr>";
              $index++;
            }
          } else {
            echo "<tr><td colspan='6'>Tidak ada data transaksi.</td></tr>";
          }
          mysqli_close($connection);
          ?>
        </tbody>
      </table>
    </div>
    <div class="text-center">
      <a href="dashboard.php" class="btn btn-primary">Kembali ke Menu Utama</a>
    </div>
  </div>

  <!-- Bootstrap JS CDN link -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
