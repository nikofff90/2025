
<?php
$nis = trim($_POST['nis']);
$filename = 'nis_nama_lulus.txt';
$nama = null;

if (file_exists($filename)) {
    $lines = file($filename);
    foreach ($lines as $line) {
        list($file_nis, $file_nama) = explode(' - ', $line);
        if ($nis === trim($file_nis)) {
            $nama = trim($file_nama);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }
        .wrap {
            background: white;
            padding: 40px;
            border-radius: 10px;
            border: 2px solid #28a745;
            width: 80%;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h2 {
            color: #28a745;
            margin-bottom: 30px;
        }
        p {
            font-size: 18px;
            line-height: 1.8;
            color: #333;
        }
        .gagal {
            color: red;
            font-size: 20px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        @media (max-width: 480px) {
            .wrap {
                padding: 20px;
                width: 90%;
            }
            p {
                font-size: 16px;
            }
            button {
                width: 100%;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<?php if ($nama): ?>
    <div class="wrap" id="hasil">
        <h2>PENGUMUMAN KELULUSAN</h2>
        <p>NIS: <strong><?= htmlspecialchars($nis) ?></strong></p>
        <p>Nama: <strong><?= htmlspecialchars($nama) ?></strong></p>
        <p>Dengan ini dinyatakan:</p>
        <p style="font-size: 22px; font-weight: bold; color: green;">LULUS</p>
        <p>Selamat dan sukses selalu untuk langkah berikutnya.</p>
    </div>

    <button onclick="downloadPDF()">Download PDF</button>
<?php else: ?>
    <div class="wrap gagal">
        NIS tidak ditemukan. Silakan coba lagi.
    </div>
<?php endif; ?>

<a href="index.html">Kembali ke Login</a>

<script>
    function downloadPDF() {
        const element = document.getElementById('hasil');
        html2pdf().from(element).set({
            margin: 1,
            filename: 'kelulusan_<?= $nis ?>.pdf',
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }
        }).save();
    }
</script>
</body>
</html>
