<?php
    // Koneksi ke database
    $servername = "localhost"; // Ganti sesuai konfigurasi server Anda
    $username = "root";        // Ganti sesuai konfigurasi server Anda
    $password = "root";            // Ganti sesuai konfigurasi server Anda
    $dbname = "testdb";    // Nama database
    $array_data = [];

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mendapatkan data dari tabel
    $sql = "select count(person_id) as jumlah_person,hobi from hobi group by hobi order by jumlah_person desc";
    $result = $conn->query($sql);
    $array_data = $result;

    // Menutup koneksi
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Hobi dan Jumlah Person</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        #searchInput {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<h2>Tabel Hobi dan Jumlah Person</h2>

<!-- Input untuk pencarian -->
<input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari Hobi...">

<!-- Tabel -->
<table id="hobiTable">
    <thead>
        <tr>
            <th>Hobi</th>
            <th>Jumlah Person</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($array_data as $key => $value) {
        ?>
            <tr>
                <td><?= $value['hobi'] ?></td>
                <td><?= $value['jumlah_person'] ?></td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<script>
    // Fungsi untuk pencarian dalam tabel
    function searchTable() {
        // Ambil input dari user
        var input = document.getElementById("searchInput");
        var filter = input.value.toLowerCase();
        var table = document.getElementById("hobiTable");
        var tr = table.getElementsByTagName("tr");

        // Looping setiap baris, sembunyikan yang tidak cocok
        for (var i = 1; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName("td")[0]; // Kolom pertama (Hobi)
            if (td) {
                var txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>
