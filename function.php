<?php
include 'dbconn.php';

function getSales($conn)
{
    $sql = "SELECT id, nama_sales FROM sales";
    $result = $conn->query($sql);
    return $result;
}

function getProduk($conn)
{
    $sql = "SELECT id, nama_produk FROM produk";
    $result = $conn->query($sql);
    return $result;
}

function tambahLead($conn, $tanggal, $id_sales, $nama_lead, $id_produk, $no_wa, $kota)
{
    // Validasi sales
    $stmt_sales = $conn->prepare("SELECT id FROM sales WHERE id = ?");
    $stmt_sales->bind_param("i", $id_sales);
    $stmt_sales->execute();
    $result_sales = $stmt_sales->get_result();

    if ($result_sales->num_rows == 0) {
        echo "Error: Sales ID tidak valid.";
        return;
    }

    // Validasi produk
    $stmt_produk = $conn->prepare("SELECT id FROM produk WHERE id = ?");
    $stmt_produk->bind_param("i", $id_produk);
    $stmt_produk->execute();
    $result_produk = $stmt_produk->get_result();

    if ($result_produk->num_rows == 0) {
        echo "Error: Produk ID tidak valid.";
        return;
    }

    // Insert data ke dalam tabel leads
    $stmt_insert = $conn->prepare("INSERT INTO leads (tanggal, id_sales, nama_lead, id_produk, no_wa, kota) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("sissss", $tanggal, $id_sales, $nama_lead, $id_produk, $no_wa, $kota);

    if ($stmt_insert->execute()) {
        echo "Lead berhasil ditambahkan.";
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_sales->close();
    $stmt_produk->close();
    $stmt_insert->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $sales_id = $_POST['sales_id'];
    $nama_lead = $_POST['nama_lead'];
    $produk_id = $_POST['produk_id'];
    $no_whatsapp = $_POST['no_wa'];
    $kota = $_POST['kota'];

    tambahLead($conn, $tanggal, $sales_id, $nama_lead, $produk_id, $no_whatsapp, $kota);
}
