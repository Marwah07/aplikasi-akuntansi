<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Penjurnalan - Menu Jurnal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            background: #f8f9fa;
        }
        .container {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .bold-label {
            font-weight: bold;
        }
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
    <script>
        function resetForm() {
            document.getElementById("myForm").reset();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2>Jurnal Transaksi</h2>
        </div>
        <form action="input_transaksi.php" method="post" id="myForm">
            <div class="form-group">
                <label for="tanggal" class="bold-label">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>

            <div class="form-group">
                <label for="nama_transaksi" class="bold-label">Nama Transaksi:</label>
                <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" placeholder="Masukkan nama transaksi" required>
            </div>

            <div class="form-group">
                <label for="akun_debet" class="bold-label">Akun Didebet:</label>
                <select class="form-control" id="akun_debet" name="akun_debet" required>
                    <?php
                    $connection = new mysqli('localhost', 'root', '', 'aplikasiakuntansi');
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    $query = "SELECT nama_coa FROM coa";
                    $result = $connection->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['nama_coa']) . "'>" . htmlspecialchars($row['nama_coa']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No data available</option>";
                    }

                    $connection->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="akun_kredit" class="bold-label">Akun Dikredit:</label>
                <select class="form-control" id="akun_kredit" name="akun_kredit" required>
                    <?php
                    $connection = new mysqli('localhost', 'root', '', 'aplikasiakuntansi');
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    $query = "SELECT nama_coa FROM coa";
                    $result = $connection->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['nama_coa']) . "'>" . htmlspecialchars($row['nama_coa']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No data available</option>";
                    }

                    $connection->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nominal" class="bold-label">Nominal:</label>
                <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Masukkan nominal" required>
            </div>

            <div class="row justify-content-between">
                <div class="col-auto">
                    <button type="submit" class="btn btn-success rounded-pill px-3 shadow-lg">Simpan</button>
                    <button type="reset" class="btn btn-danger rounded-pill px-3 shadow-lg" onclick="resetForm();">Batal</button>
                </div>
                <div class="col-auto">
                    <a href="dashboard.php" class="btn btn-secondary rounded-pill px-3 shadow-lg">Kembali</a>
                </div>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $connection = new mysqli('localhost', 'root', '', 'aplikasiakuntansi');
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $tanggal = $_POST["tanggal"];
            $nama_transaksi = $_POST["nama_transaksi"];
            $akun_debet = $_POST["akun_debet"];
            $akun_kredit = $_POST["akun_kredit"];
            $nominal = $_POST["nominal"];

            // Fetch the account types for debet and kredit accounts
            $queryDebetType = "SELECT jenis FROM coa WHERE nama_coa = ?";
            $stmtDebetType = $connection->prepare($queryDebetType);
            $stmtDebetType->bind_param("s", $akun_debet);
            $stmtDebetType->execute();
            $stmtDebetType->bind_result($jenisDebet);
            $stmtDebetType->fetch();
            $stmtDebetType->close();

            $queryKreditType = "SELECT jenis FROM coa WHERE nama_coa = ?";
            $stmtKreditType = $connection->prepare($queryKreditType);
            $stmtKreditType->bind_param("s", $akun_kredit);
            $stmtKreditType->execute();
            $stmtKreditType->bind_result($jenisKredit);
            $stmtKreditType->fetch();
            $stmtKreditType->close();

            // Insert the transaction
            $query = "INSERT INTO table_transaksi (tanggal, nama_transaksi, akun_debet, akun_kredit, nominal) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ssssd", $tanggal, $nama_transaksi, $akun_debet, $akun_kredit, $nominal);

            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil disimpan.');</script>";

                // Update saldo pada table_coa untuk akun debet dan kredit
                if ($jenisDebet == 'Aktiva' || $jenisDebet == 'Beban Pengeluaran') {
                    $updateQueryDebet = "UPDATE coa SET saldo = saldo + ? WHERE nama_coa = ?";
                } else if ($jenisDebet == 'Pasiva' || $jenisDebet == 'Modal' || $jenisDebet == 'Pendapatan') {
                    $updateQueryDebet = "UPDATE coa SET saldo = saldo - ? WHERE nama_coa = ?";
                }

                if ($jenisKredit == 'Aktiva' || $jenisKredit == 'Beban Pengeluaran') {
                    $updateQueryKredit = "UPDATE coa SET saldo = saldo - ? WHERE nama_coa = ?";
                } else if ($jenisKredit == 'Pasiva' || $jenisKredit == 'Modal' || $jenisKredit == 'Pendapatan') {
                    $updateQueryKredit = "UPDATE coa SET saldo = saldo + ? WHERE nama_coa = ?";
                }

                // Execute update queries
                $stmtUpdateDebet = $connection->prepare($updateQueryDebet);
                $stmtUpdateDebet->bind_param("ds", $nominal, $akun_debet);
                $stmtUpdateDebet->execute();
                $stmtUpdateDebet->close();

                $stmtUpdateKredit = $connection->prepare($updateQueryKredit);
                $stmtUpdateKredit->bind_param("ds", $nominal, $akun_kredit);
                $stmtUpdateKredit->execute();
                $stmtUpdateKredit->close();

                // Redirect to view_coa.php
                header("Location: view_coa.php");
                exit();
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
            $connection->close();
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
