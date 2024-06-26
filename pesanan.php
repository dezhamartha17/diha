
<?php
session_start();
include "connect.php";

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
$user_id = $_SESSION['id_users'];
// Query to get cart items
$sql = "
    SELECT pembelian.id_order, pembelian.id_pembeli, pembelian.id_cart, pembelian.total_harga, pembelian.alamat,
           GROUP_CONCAT(cart.id_cart) AS id_cart,
           GROUP_CONCAT(cart.jumlah) AS jumlah,
           GROUP_CONCAT(produk.nama_produk) AS nama_produk,
           GROUP_CONCAT(produk.deskripsi_produk) AS deskripsi_produk,
           GROUP_CONCAT(produk.harga_produk) AS harga_produk,
           GROUP_CONCAT(produk.gambar) AS gambar
    FROM pembelian
    INNER JOIN cart ON FIND_IN_SET(cart.id_cart, pembelian.id_cart)
    INNER JOIN produk ON FIND_IN_SET(produk.id_produk, cart.id_product)
    WHERE pembelian.id_pembeli = $user_id
    GROUP BY pembelian.id_pembeli
";
$result = $connect->query($sql);

$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiHa Barbershop Store</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Optional: Include any custom styles here -->
    <style>
        /* Custom styles can be added here */
    </style>
</head>
<style>

</style>
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
                <a href="product.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                   <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                      <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                   </svg>
                   <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Products</span>
                </a>
             </li>
           <li>
              <a href="cart.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                 </svg>
                 <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Cart</span>
                 <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300"></span>
              </a>
           </li>
           <li>
              <a href="pesanan.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                 </svg>
                 <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Pesanan Saya</span>

              </a>
           </li>
           <li>
              <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                 <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                 </svg>
                 <span class="flex-1 ms-3 ml-2 whitespace-nowrap">Logout</span>
              </a>
           </li>
        </ul>
     </div>
  </aside>
  <div class="p-4 sm:ml-64">
    <div class="mt-14 mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Daftar Item Cart -->
        <div class="flex flex-col divide-y divide-gray-200">
            <!-- Item 1 -->
            <?php
            $checkboxes = '';
               if ($result->num_rows > 0) {
                     // Output data of each row
                     while($row = $result->fetch_assoc()) {
                        $alamat_pengiriman = $row['alamat'];
                        if ($alamat_pengiriman != '0') {
                            $addressClass = 'hidden';
                            $alamat = 'green';
                            $ceklis = '';
                            $ceklisPayment = '';
                            $paymentClass = '';
                        } else {
                            $addressClass = '';
                            $alamat = 'blue';
                            $ceklis = 'hidden';
                            $ceklisPayment = 'hidden';
                            $paymentClass = 'hidden';
                        }
                        
                        $harga_produk_array = explode(',', $row['harga_produk']);
                        $harga_produk_float = array_map('floatval', $harga_produk_array);
                        $harga_produk_formatted = array_map(fn($harga) => 'Rp. ' . number_format($harga, 0), $harga_produk_float);
                
                        // Separate gambar, nama_produk, harga_produk into arrays
                        $gambar_array = explode(',', $row['gambar']);
                        $nama_produk_array = explode(',', $row['nama_produk']);
                        $deskripsi_produk_array = explode(',', $row['deskripsi_produk']);
                        $jumlah_array = explode(',', $row['jumlah']);
                        
                        // Loop through each item
                        for ($i = 0; $i < count($gambar_array); $i++) {
                            $harga_total = $harga_produk_float[$i] * $jumlah_array[$i];
                            $harga_total_formatted = 'Rp. ' . number_format($harga_total, 0);
                            $checkboxes .= '
                            <div class="flex items-center space-x-4 p-4 border-b border-gray-200">
                                <input type="checkbox" name="id_order[]" value="' . $row["id_order"] . '" class="form-checkbox h-5 w-5 text-blue-600">
                                <img class="w-16 h-16 object-cover rounded-md" src="assets/img/' . $gambar_array[$i] . '" alt="Product Thumbnail">
                                <div class="flex flex-col flex-grow">
                                    <span class="font-semibold text-gray-700">' . $jumlah_array[$i] . ' ' . $nama_produk_array[$i] . '</span>
                                    <span class="text-sm text-gray-500">' . $deskripsi_produk_array[$i] . '</span>
                                    <span class="text-gray-700">' . $harga_total_formatted . '</span>
                                </div>
                            </div>
                            
                            <!-- Modal for detailed item view -->
                            <div id="modal_' . $row["id_order"] . '_' . $i . '" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                <div class="flex items-center justify-center min-h-screen p-4">
                                    <!-- Modal background -->
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    
                                    <!-- Modal content -->
                                    <div class="bg-white rounded-lg overflow-hidden max-w-lg w-full p-8 mx-auto relative">
                                        <div class="flex justify-end">
                                            <button class="text-gray-400 hover:text-gray-600 absolute top-4 right-4" onclick="closeModal(\'modal_' . $row["id_order"] . '_' . $i . '\')">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-center">
                                            <img class="w-32 h-32 object-cover rounded-md mx-auto mb-4" src="assets/img/' . $gambar_array[$i] . '" alt="Product Thumbnail">
                                            <h2 class="text-xl font-semibold text-gray-800 mb-2">' . $nama_produk_array[$i] . '</h2>
                                            <p class="text-sm text-gray-600 mb-2">' . $deskripsi_produk_array[$i] . '</p>
                                            <p class="text-gray-700">' . $harga_total_formatted . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            
                            $total_price += $harga_produk_float[$i];
                        }
                    }
                } else {
                    echo "<p>No items in cart</p>";
                }
                
                $connect->close();
                ?>
                     <!-- Total dan Tombol Checkout -->
         <div class="flex justify-between px-4 py-3">
            <span class="font-semibold text-gray-700"></span>
            <!-- <span class="font-semibold text-gray-700">Total Harga: Rp.<?php echo number_format($total_price, 0); ?></span> -->
            <!-- <button id="checkoutBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">Checkout</button> -->
         </div>
        </div>
            <ol class="mt-10 ml-10 mb-10 mr-10 space-y-4 w-auto">
                <li>
                    <div class="w-full p-4 text-<?php echo $alamat; ?>-700 border border-<?php echo $alamat; ?>-300 rounded-lg bg-<?php echo $alamat; ?>-50 dark:bg-gray-800 dark:border-<?php echo $alamat; ?>-800 dark:text-<?php echo $alamat; ?>-400" role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">User info</span>
                            <h3 class="font-medium">1. Address & Item Info</h3>
                            <svg class="w-4 h-4 <?php echo $ceklis; ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <form class="max-w-auto mx-auto <?php echo $addressClass; ?>" action="address_submit.php" method="POST">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            </div>
                            <input type="text" id="nama" name="nama" class="mt-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Pembeli">
                            <input type="number" id="phone" name="phone" min="0" class="mt-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="No. Handphone">
                            <input type="text" id="alamat" name="alamat" class="mt-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alamat Pembeli">
                            <br>
                            <!-- Reminder -->
                            <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 mb-4">
                                <p class="font-bold">Reminder</p>
                                <p>Pastikan Anda mencentang item yang akan dibeli saja.</p>
                            </div>
                            <?php echo $checkboxes; ?>
                            <button id="checkoutBtn" class="mt-5 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300">Submit</button>
                        </div>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="w-full p-4 text-<?php echo $payment; ?>-700 border border-<?php echo $payment; ?>-300 rounded-lg bg-<?php echo $payment; ?>-50 dark:bg-gray-800 dark:border-<?php echo $color; ?>-800 dark:text-<?php echo $color; ?>-400" role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">Payment Method</span>
                            <h3 class="font-medium">2. Payment Method</h3>
                            <svg class="w-4 h-4 <?php echo $ceklisPayment; ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <!-- <h2 class="text-lg font-semibold">Pilih Metode Pengiriman</h2> -->
                        <form <?php echo $paymentClass; ?> action="payment_submit.php" method="POST">
                        <div class="flex space-x-6">
                                <!-- Card Reguler -->
                                <div class="w-full bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="reguler" name="shipping_type" value="1" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <div class="h-10 w-10 flex items-center justify-center bg-blue-100 rounded-full">
                                        <i class="fas fa-truck text-blue-600"></i>
                                    </div>
                                    <label for="reguler" class="flex-1">
                                        <h2 class="text-lg font-semibold">Reguler</h2>
                                        <p class="text-gray-600">Pengiriman standar, estimasi 3-5 hari.</p>
                                        <p class="text-gray-600">Rp. 10.000.</p>
                                    </label>
                                </div>
                                <!-- Card Express -->
                                <div class="w-full bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="express" name="shipping_type" value="2" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <div class="h-10 w-10 flex items-center justify-center bg-red-100 rounded-full">
                                        <i class="fas fa-shipping-fast text-red-600"></i>
                                    </div>
                                    <label for="express" class="flex-1">
                                        <h2 class="text-lg font-semibold">Express</h2>
                                        <p class="text-gray-600">Pengiriman cepat, estimasi 1-2 hari.</p>
                                        <p class="text-gray-600">Rp. 12.000.</p>

                                    </label>
                                </div>
                                <!-- Card Same-Day -->
                                <div class="w-full bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="same-day" name="shipping_type" value="3" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <div class="h-10 w-10 flex items-center justify-center bg-green-100 rounded-full">
                                        <i class="fas fa-shipping-fast text-green-600"></i>
                                    </div>
                                    <label for="same-day" class="flex-1">
                                        <h2 class="text-lg font-semibold">Same-Day</h2>
                                        <p class="text-gray-600">Pengiriman di hari yang sama.</p>
                                        <p class="text-gray-600">Rp. 17.000.</p>

                                    </label>
                                </div>
                            </div>
                            <div class="mt-6">
                                <!-- <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700">
                                    Submit
                                </button> -->
                            </div>
                        <h2 class="text-lg font-semibold">Pilih Metode Pembayaran</h2>

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Card 1 -->
                                <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="option1" name="options" value="1" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <img src="assets/img/cod.jpeg" alt="icon" class="h-10 w-10 rounded-full">
                                    <label for="option1" class="flex-1">
                                        <h2 class="text-lg font-semibold">COD</h2>
                                        <p class="text-gray-600">Biaya layanan +6.000.</p>
                                    </label>
                                </div>
                                <!-- Card 2 -->
                                <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="option2" name="options" value="2" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <img src="assets/img/bca.jpeg" alt="icon" class="h-10 w-10 rounded-full">
                                    <label for="option2" class="flex-1">
                                        <h2 class="text-lg font-semibold">BCA</h2>
                                        <p class="text-gray-600">Biaya layanan +8.000.</p>
                                    </label>
                                </div>
                                <!-- Card 3 -->
                                <div class="bg-white rounded-lg shadow-md p-6 flex items-center space-x-4">
                                    <input type="radio" id="option3" name="options" value="3" class="form-radio h-6 w-6 text-blue-600 rounded-full">
                                    <img src="assets/img/dana.jpeg" alt="icon" class="h-10 w-10 rounded-full">
                                    <label for="option3" class="flex-1">
                                        <h2 class="text-lg font-semibold">DANA</h2>
                                        <p class="text-gray-600">Biaya Layanan +5.000.</p>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg shadow-md hover:bg-blue-700">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
                <li>
                    <div class="w-full p-4 text-<?php echo $color; ?>-700 bg-<?php echo $color; ?>-100 border border-<?php echo $color; ?>-300 rounded-lg dark:bg-gray-800 dark:border-<?php echo $color; ?>-800 dark:text-<?php echo $color; ?>-400" role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">Social accounts</span>
                            <h3 class="font-medium">3. Social accounts</h3>
                            <svg class="w-4 h-4 <?php echo $ceklis; ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                    </div>
                </li>
                <!-- <li>
                    <div class="w-full p-4 text-<?php echo $color; ?>-900 bg-<?php echo $color; ?>-100 border border-<?php echo $color; ?>-300 rounded-lg dark:bg-<?php echo $color; ?>-800 dark:border-<?php echo $color; ?>-700 dark:text-<?php echo $color; ?>-400" role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">Review</span>
                            <h3 class="font-medium">4. Review</h3>
                            <svg class="w-4 h-4 <?php echo $ceklis; ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                    </div>
                </li> -->
                <!-- <li>
                    <div class="w-full p-4 text-<?php echo $color; ?>-900 bg-<?php echo $color; ?>-100 border border-<?php echo $color; ?>-300 rounded-lg dark:bg-<?php echo $color; ?>-800 dark:border-<?php echo $color; ?>-700 dark:text-<?php echo $color; ?>-400" role="alert">
                        <div class="flex items-center justify-between">
                            <span class="sr-only">Confirmation</span>
                            <h3 class="font-medium">5. Confirmation</h3>
                            <svg class="w-4 h-4 <?php echo $ceklis; ?>" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                    </div>
                </li> -->
            </ol>
        </div>
    </div>
</div>

<div class="flex-1 p-4 sm:mr-64">
    <div class="mt-14 mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Checkout</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Please review your order and proceed to checkout.</p>
            </div>



        </div>
    </div>
</div>



    <!-- Optional: JavaScript for mobile menu toggle or other interactions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
    // Simulate checkout success event
    document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_GET['address_success']) && $_GET['address_success'] == '1') {
              echo "showSuccessAddress();";
            }
            ?>
        });
    function showSuccessAddress() {
            Swal.fire({
                title: "Addressed Successful!",
                text: "Your Address successfully placed.",
                icon: "success",
                timer: 3000, // Close the modal after 3 seconds
                timerProgressBar: true,
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pesanan.php';  // Redirect to checkout page
                }
            });
        }

            // Simulate checkout success event
    document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_GET['payment_success']) && $_GET['payment_success'] == '1') {
              echo "showSuccessPayment();";
            }
            ?>
        });
    function showSuccessPayment() {
            Swal.fire({
                title: "Payment Method Successful!",
                text: "Your Payment Method successfully placed.",
                icon: "success",
                timer: 3000, // Close the modal after 3 seconds
                timerProgressBar: true,
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pesanan.php';  // Redirect to checkout page
                }
            });
        }
    </script>
</body>
</html>
