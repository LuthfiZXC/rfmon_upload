<?php
// Nama file yang akan didownload
$file = '/home/pi/monsfer/level/'.$_GET["filename"];

// Nama untuk file saat didownload (opsional)
$filename = $_GET["filename"];

// Mengecek apakah file ada
if (file_exists($file)) {
    // Header untuk memperbolehkan download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.($filename).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // Membaca file dan menampilkan isinya ke output buffer
    readfile($file);
    exit;
} else {
    // Jika file tidak ditemukan
    echo "File tidak ditemukan.";
}
?>

