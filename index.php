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
    <!-- Memanggil Font Awesome untuk ikon alat kesehatan/medis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #eef2f5; /* Warna abu-abu lembut yang selaras dengan biru */
            color: #333;
            position: relative;
            min-height: 100vh;
            box-sizing: border-box;
        }
        
        /* Container Utama untuk membungkus konten */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        /* Logo Medis di Kanan Atas */
        .medical-logo {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 55px; /* Ukuran logo */
            color: #1e40af; /* Warna biru senada dengan header tabel */
            opacity: 0.8;
            background: rgba(255, 255, 255, 0.7);
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        h2 {
            color: #1e3a8a;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #1e40af; /* Warna Biru Utama */
            color: white;
            padding: 14px 18px;
            text-align: left;
            font-weight: 600;
            font-size: 15px;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            font-size: 15px;
        }

        /* Zebra Striping Abu-abu */
        tr:nth-child(even) {
            background-color: #f8fafc; 
        }

        tr:hover {
            background-color: #f1f5f9; /* Hover abu-abu manis */
        }

        .btn-tambah {
            display: inline-block;
            padding: 11px 22px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .btn-tambah:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-aksi {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

        .btn-aksi:hover {
            text-decoration: underline;
        }

        /* Bagian Identitas */
        .identity {
            margin-top: 35px;
            font-size: 14px;
            color: #6b7280;
            font-weight: 600;
            border-top: 2px solid #cbd5e1;
            padding-top: 15px;
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- LOGO TEMA ALAT KESEHATAN (Stetoskop & Detak Jantung) -->
        <div class="medical-logo">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

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

        <!-- IDENTITAS BAWAH -->
        <div class="identity">
            Dikembangkan oleh: Syahrul Syahrama (2202505112)
        </div>
    </div>

</body>
</html>