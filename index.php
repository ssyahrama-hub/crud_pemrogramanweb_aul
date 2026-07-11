<?php
// Hubungkan dengan file konfigurasi database
include_once("config.php");

// Logika Pencarian Data
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($mysqli, $_GET['search']);
    // Cari berdasarkan Nama Alat, Merek, atau Lokasi
    $query = "SELECT * FROM alat WHERE 
              nama_alat LIKE '%$search%' OR 
              merek LIKE '%$search%' OR 
              lokasi LIKE '%$search%' 
              ORDER BY id DESC";
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $query = "SELECT * FROM alat ORDER BY id DESC";
}

$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIM-RS DATA ALAT KESEHATAN</title>
    <!-- Memanggil Font Awesome untuk ikon alat kesehatan/medis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #eef2f5; /* Warna abu-abu lembut */
            color: #333;
            position: relative;
            min-height: 100vh;
            box-sizing: border-box;
        }
        
        /* Container Utama */
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
            font-size: 55px;
            color: #1e40af;
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
            text-transform: uppercase;
        }

        /* Wrapper untuk Tombol Tambah dan Form Cari */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
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

        /* Form Pencarian Elegan */
        .search-form {
            display: flex;
            gap: 5px;
        }

        .search-input {
            padding: 10px 15px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            width: 250px;
            outline: none;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn-cari {
            padding: 10px 18px;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-cari:hover {
            background-color: #1d4ed8;
        }

        .btn-reset {
            padding: 10px 14px;
            background-color: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-reset:hover {
            background-color: #4b5563;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #1e40af;
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

        tr:nth-child(even) {
            background-color: #f8fafc; 
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        .btn-aksi {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

        .btn-aksi:hover {
            text-decoration: underline;
        }

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

        .empty-row {
            text-align: center;
            color: #9ca3af;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- LOGO TEMA ALAT KESEHATAN -->
        <div class="medical-logo">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>

        <h2>SIM-RS DATA ALAT KESEHATAN</h2>

        <!-- BAR AKSI (TOMBOL TAMBAH & FORM CARI SEJAJAR) -->
        <div class="action-bar">
            <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a>
            
            <form action="index.php" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari alat, merek, atau lokasi..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn-cari"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                <?php if ($search != ""): ?>
                    <a href="index.php" class="btn-reset">Reset</a>
                <?php endif; ?>
            </form>
        </div>

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
                if (mysqli_num_rows($result) > 0) {
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
                } else {
                    echo "<tr><td colspan='5' class='empty-row'>Data alat tidak ditemukan atau tidak tersedia.</td></tr>";
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