<?php
// Hubungkan dengan file konfigurasi database
include_once("config.php");

// Ambil semua data dari tabel alat (diurutkan dari yang terbaru)
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sim Rs - Data Alat</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #ffa500;
            color: black;
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .btn-tambah {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .btn-tambah:hover {
            background-color: #0056b3;
        }
        .btn-aksi {
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Daftar Data Alat</h2>

    <!-- TOMBOL UNTUK MENUJU KE HALAMAN TAMBAH DATA -->
    <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a>

    <table>
        <tr>
            <th>Nama Alat</th>
            <th>Tahun</th>
            <th>Merek</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>

        <?php  
        // Melakukan perulangan untuk menampilkan data dari database
        while($user_data = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$user_data['nama_alat']."</td>";
            echo "<td>".$user_data['tahun']."</td>";
            echo "<td>".$user_data['merek']."</td>";
            echo "<td>".$user_data['lokasi']."</td>";    
            echo "<td>
                    <a class='btn-aksi' href='edit.php?id=$user_data[id]'>Edit</a> | 
                    <a class='btn-aksi' style='color:red;' href='delete.php?id=$user_data[id]' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                  </td>";
            echo "</tr>";        
        }
        ?>
    </table>

</body>
</html>