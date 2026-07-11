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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 30px;
            background-color: #f8f9fa;
            color: #333;
        }
        h2 {
            color: #1e3a8a;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background-color: #1e40af; /* Warna Biru Utama */
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb; /* Garis abu-abu tipis */
            color: #4b5563;
        }
        /* Efek warna selang-seling abu-abu pada baris tabel (Zebra Striping) */
        tr:nth-child(even) {
            background-color: #f3f4f6; 
        }
        tr:hover {
            background-color: #e5e7eb; /* Efek hover abu-abu saat kursor di atas baris */
        }
        .btn-tambah {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2563eb; /* Biru Tombol */
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.2s;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
        }
        .btn-tambah:hover {
            background-color: #1d4ed8;
        }
        .btn-aksi {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }
        .btn-aksi:hover {
            text-decoration: underline;
        }
        /* Styling untuk teks identitas di bawah tabel */
        .identity {
            margin-top: 25px;
            font-size: 14px;
            color: #6b7280; /* Abu-abu teks */
            font-weight: 600;
            border-top: 2px solid #e5e7eb;
            padding-top: 10px;
            display: inline-block;
            width: 80%;
        }
    </style>
</head>
<body>

    <h2>Daftar Data Alat</h2>

    <!-- TOMBOL TAMBAH DATA -->
    <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a>

    <table>
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Tahun</th>
                <th>Merek</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
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
                        <a class='btn-aksi' style='color:#dc2626;' href='delete.php?id=$user_data[id]' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                      </td>";
                echo "</tr>";        
            }
            ?>
        </tbody>
    </table>

    <!-- BAGIAN BAWAH TABEL: IDENTITAS -->
    <div class="identity">
        Dikembangkan oleh: Syahrul Syahrama (2202505112)
    </div>

</body>
</html>