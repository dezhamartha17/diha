<?php
// Include TCPDF library
// require_once('tcpdf/tcpdf.php');
include 'config.php'; // Sesuaikan dengan file koneksi Anda
require_once('tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Ambil ID Order dari parameter GET atau POST
$idOrder = $_GET['id_order']; // Contoh, sesuaikan dengan cara Anda mengambil ID Order

// Query untuk mengambil data pembelian dengan detail produk
$sql = "
    SELECT pembelian.id_order, pembelian.alamat, pembelian.nama_pembeli, pembelian.phone, pembelian.status_pembayaran, pembelian.metode_pengiriman,
           GROUP_CONCAT(produk.id_produk) AS id_produk,
           GROUP_CONCAT(produk.nama_produk) AS nama_produk,
           GROUP_CONCAT(produk.deskripsi_produk) AS deskripsi_produk,
           GROUP_CONCAT(produk.harga_produk) AS harga_produk,
           GROUP_CONCAT(produk.gambar) AS gambar,
           GROUP_CONCAT(cart.jumlah) AS jumlah_produk
    FROM pembelian
    INNER JOIN cart ON FIND_IN_SET(cart.id_cart, pembelian.id_cart)
    INNER JOIN produk ON FIND_IN_SET(produk.id_produk, cart.id_product)
    WHERE pembelian.id_order = $idOrder
    GROUP BY pembelian.id_order
    ORDER BY pembelian.id_order ASC
";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    // Memeriksa apakah ada data yang ditemukan
    while($row = $result->fetch_assoc()) {
        // Membuat objek TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Atur informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Resi Pesanan #' . $idOrder);
        $pdf->SetSubject('Resi Pesanan');
        $pdf->SetKeywords('Resi, Pesanan, PDF, TCPDF');

        // Atur header dan footer
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Atur margin
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Atur font
        $pdf->SetFont('helvetica', '', 12);

        // Tambahkan halaman
        $pdf->AddPage();

        // Tampilkan isi resi berdasarkan data yang sudah diambil
        $html = '
        <h1 style="text-align:center;">Resi Pesanan #' . $idOrder . '</h1>
        <p><strong>Alamat:</strong> ' . $row['alamat'] . '</p>
        <p><strong>Nama Pembeli:</strong> ' . $row['nama_pembeli'] . '</p>
        <p><strong>Telepon:</strong> ' . $row['phone'] . '</p>
        <p><strong>Status Pembayaran:</strong> ' . ($row['status_pembayaran'] == 1 ? 'Belum Lunas' : 'Lunas') . '</p>
        <p><strong>Metode Pengiriman:</strong> ';
        
        switch ($row['metode_pengiriman']) {
            case 1:
                $html .= 'Regular';
                break;
            case 2:
                $html .= 'Express';
                break;
            case 3:
                $html .= 'Same Day';
                break;
            default:
                $html .= 'Unknown';
                break;
        }
        
        $html .= '</p>
        <br>
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        ';

        // Mengurai data produk
        $id_produk_array = explode(',', $row['id_produk']);
        $nama_produk_array = explode(',', $row['nama_produk']);
        $deskripsi_produk_array = explode(',', $row['deskripsi_produk']);
        $harga_produk_array = explode(',', $row['harga_produk']);
        $jumlah_produk_array = explode(',', $row['jumlah_produk']);

        // Loop untuk menampilkan detail produk
        for ($i = 0; $i < count($id_produk_array); $i++) {
            $total_harga = $harga_produk_array[$i] * $jumlah_produk_array[$i];
            $html .= '
            <tr>
                <td>' . ($i + 1) . '</td>
                <td>' . $nama_produk_array[$i] . '</td>
                <td>' . $deskripsi_produk_array[$i] . '</td>
                <td>Rp ' . number_format($harga_produk_array[$i], 0, ',', '.') . '</td>
                <td>' . $jumlah_produk_array[$i] . '</td>
                <td>Rp ' . number_format($total_harga, 0, ',', '.') . '</td>
            </tr>
            ';
        }

        $html .= '
        </table>
        ';

        // Tambahkan isi ke dokumen PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output ke file atau browser (dalam contoh ini, akan mengunduh PDF)
        $pdf->Output('resi_pesanan_' . $idOrder . '.pdf', 'D');

        // Tutup koneksi database jika sudah selesai
        $connect->close();

        // Selesai
        exit;
    }
} else {
    // Jika tidak ada data ditemukan
    echo "Data pesanan tidak ditemukan.";
}
?>
