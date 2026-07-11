<?php
// Hubungkan dengan file konfigurasi database
include_once("config.php");

// Cek apakah tombol update data (submit) sudah diklik
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $nama_alat = mysqli_real_escape_string($mysqli, $_POST['nama_alat']);
    $tahun = mysqli_real_escape_string($mysqli, $_POST['tahun']);
    $merek = mysqli_real_escape_string($mysqli, $_POST['merek']);
    $lokasi = mysqli_real_escape_string($mysqli, $_POST['lokasi']);

    // Query untuk mengupdate data alat
    $result = mysqli_query($mysqli, "UPDATE alat SET nama_alat='$nama_alat', tahun='$tahun', merek='$merek', lokasi='$lokasi' WHERE id=$id");

    // Jika berhasil, alihkan kembali ke halaman utama
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($mysqli);
    }
}

// Ambil ID dari URL (?id=...) untuk menampilkan data lama di form
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);
    
    // Ambil data berdasarkan ID tersebut
    $result = mysqli_query($mysqli, "SELECT * FROM alat WHERE id=$id");

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_array($result);
        $nama_alat = $user_data['nama_alat'];
        $tahun = $user_data['tahun'];
        $merek = $user_data['merek'];
        $lokasi = $user_data['lokasi'];
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke index
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Alat Kesehatan</title>
    <!-- Memanggil Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            background-color: #eef2f5; /* Background abu-abu lembut */
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .card {
            background-color: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #cbd5e1;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        h3 {
            color: #1e3a8a;
            margin: 0;
            text-transform: uppercase;
            font-size: 20px;
        }

        .medical-icon {
            font-size: 24px;
            color: #1e40af;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-submit {
            flex: 2;
            padding: 11px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 14px;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .btn-kembali {
            flex: 1;
            padding: 11px;
            background-color: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            transition: background 0.2s;
            font-size: 14px;
        }

        .btn-kembali:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-pen-to-square"></i> Edit Data Alat</h3>
            <div class="medical-icon"><i class="fa-solid fa-heart-pulse"></i></div>
        </div>

        <form name="update_alat" method="post" action="edit.php">
            <div class="form-group">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control" value="<?php echo htmlspecialchars($nama_alat); ?>" required>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" value="<?php echo htmlspecialchars($tahun); ?>" required>
            </div>

            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" class="form-control" value="<?php echo htmlspecialchars($merek); ?>" required>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="<?php echo htmlspecialchars($lokasi); ?>" required>
            </div>

            <!-- Input hidden untuk menampung ID alat yang diedit -->
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <div class="btn-container">
                <a href="index.php" class="btn-kembali">Batal</a>
                <button type="submit" name="update" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>