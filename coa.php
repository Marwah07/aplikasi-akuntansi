<?php
$connection = mysqli_connect('localhost', 'root', '', 'aplikasiakuntansi');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Input COA
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['input_coa'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $sql = "INSERT INTO coa (kode, nama, tipe) VALUES ('$kode', '$nama', '$tipe')";
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Edit COA
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_coa'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $sql = "UPDATE coa SET kode='$kode', nama='$nama', tipe='$tipe' WHERE id='$id'";
    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// View COA
$sql = "SELECT * FROM coa";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chart of Accounts (COA)</title>
</head>
<body>
    <h1>Chart of Accounts (COA)</h1>
    <form method="post">
        <h3>Input COA</h3>
        Kode: <input type="text" name="kode" required>
        Nama: <input type="text" name="nama" required>
        Tipe: <input type="text" name="tipe" required>
        <button type="submit" name="input_coa">Input COA</button>
    </form>
    <h3>View/Edit COA</h3>
    <table border="1">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <form method='post'>
                            <td><input type='text' name='kode' value='".$row['kode']."' required></td>
                            <td><input type='text' name='nama' value='".$row['nama']."' required></td>
                            <td><input type='text' name='tipe' value='".$row['tipe']."' required></td>
                            <td>
                                <input type='hidden' name='id' value='".$row['id']."'>
                                <button type='submit' name='edit_coa'>Edit</button>
                            </td>
                        </form>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
