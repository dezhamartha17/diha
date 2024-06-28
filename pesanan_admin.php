<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiHa Barbershop Store</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan link ke SweetAlert CDN di bagian head atau sebelum Anda memanggil fungsi prosesPesanan -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Optional: Include any custom styles here -->
    <style>
        /* Custom styles can be added here */
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            min-height: 400px; /* Set minimum height for the card */
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            flex-grow: 1;
        }
        .card-title {
            min-height: 56px;
        }
        .card-description {
            min-height: 72px;
        }
        .card-footer {
            padding: 1rem;
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="assets/img/logo.png" class="h-1 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">DiHa Barber Store</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="pesanan_admin.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-4h2v4a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Order</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <?php
            include 'config.php'; // Adjust with your connection file

            // Query to fetch purchase data with product details
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
                GROUP BY pembelian.id_order
                ORDER BY pembelian.id_order ASC
            ";

            $result = $connect->query($sql);

            // Check if there is data retrieved
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Splitting the retrieved data
                    $id_produk_array = explode(',', $row['id_produk']);
                    $nama_produk_array = explode(',', $row['nama_produk']);
                    $deskripsi_produk_array = explode(',', $row['deskripsi_produk']);
                    $harga_produk_array = explode(',', $row['harga_produk']);
                    $gambar_produk_array = explode(',', $row['gambar']);
                    $jumlah_produk_array = explode(',', $row['jumlah_produk']);

                    // Display purchase details
                    echo '
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Purchase Detail</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Order ID: ' . $row['id_order'] . '</p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Address: ' . $row['alamat'] . '</p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Name: ' . $row['nama_pembeli'] . '</p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Phone: ' . $row['phone'] . '</p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Payment Status: ' . ($row['status_pembayaran'] == 1 ? 'Not Paid' : 'Paid') . '</p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Delivery Method: ';
                            
                    switch ($row['metode_pengiriman']) {
                        case 1:
                            echo 'Regular';
                            break;
                        case 2:
                            echo 'Express';
                            break;
                        case 3:
                            echo 'Same Day';
                            break;
                        default:
                            echo 'Unknown';
                            break;
                    }
                    
                    echo '</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                    ';

                    // Loop to display products related to this order
                    for ($i = 0; $i < count($id_produk_array); $i++) {
                        echo '
                        <div class="bg-white overflow-hidden sm:rounded-lg mb-2 flex items-center">
                            <div class="px-4 py-5 sm:px-6">
                                <img class="w-16 h-16 rounded-full" src="assets/img/' . $gambar_produk_array[$i] . '" alt="Product Image">
                            </div>
                            <div class="px-4 py-5 sm:px-6 flex-1">
                                <div class="text-sm font-medium text-gray-900">' . $jumlah_produk_array[$i] . ' - ' . $nama_produk_array[$i] . '</div>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-2 mt-2">
                                <div class="text-sm text-gray-500">Price:</div>
                                <div class="text-sm text-gray-500">Rp '. number_format($harga_produk_array[$i], 0, ',', '.') .'</div>
                                <div class="text-sm text-gray-500">Total Price:</div>
                                <div class="text-sm text-gray-500">Rp '. number_format($harga_produk_array[$i] * $jumlah_produk_array[$i], 0, ',', '.') .'</div>
                            </div>
                        </div>
                    </div>
                        ';
                    }

                    // Product detail button
                    echo '
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button onclick="prosesPesanan(' . $row['id_order'] . ')" type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Proses Pesanan
                            </button>
                        </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="button" onclick="cetakResi(' . $row['id_order'] . ')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Cetak Resi
                            </button>
                        </div>
                    </div>
                    ';
                }

            } else {
                echo "No purchase data available.";
            }
            $connect->close();
        ?>

        </div>
    </div>

    <!-- Optional: JavaScript for mobile menu toggle or other interactions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // Function to toggle detail visibility
        function toggleDetail(button) {
            const detailContainer = button.closest('.bg-white').querySelector('.px-4.py-5.sm\\:px-6');
            detailContainer.classList.toggle('hidden'); // Toggle the 'hidden' class on the detail container
        }

    function prosesPesanan(idOrder) {
        // Kirim permintaan AJAX ke server
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "update_status_pesanan.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Respons dari server
                    console.log(xhr.responseText);
                    // Tampilkan SweetAlert untuk memberitahu pengguna
                    Swal.fire({
                        icon: 'success',
                        title: 'Status pesanan berhasil diperbarui!',
                        showConfirmButton: false,
                        timer: 1500 // Durasi tampilan pesan (ms)
                    }).then(() => {
                        // Lakukan manipulasi UI lainnya, misalnya refresh halaman
                        window.location.reload();
                    });
                } else {
                    // Handle kesalahan dengan SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memperbarui status pesanan.',
                        footer: '<a href>But why?</a>'
                    });
                    console.error("Terjadi kesalahan: " + xhr.status);
                }
            }
        };
        // Kirim data ID Order yang ingin diperbarui statusnya
        xhr.send("id_order=" + idOrder + "&status_pesanan=2");
    }

    function cetakResi(idOrder) {
    // Kirim permintaan AJAX ke server atau buat URL cetak resi sesuai dengan kebutuhan
    let url = "cetak_resi.php?id_order=" + idOrder;
    
    // Buka jendela baru atau lakukan navigasi ke URL cetak resi
    window.open(url, '_blank');
}
    </script>
</body>
</html>
