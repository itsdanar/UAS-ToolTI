<?php
	session_start();
	if (!isset($_SESSION["sesi"]) && $_SESSION["sesi"] == 'pegawai') {
		header('location: login.php');
	}else{
		include('koneksi.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body>
    <?php
    $login=mysqli_query($koneksi,"SELECT * FROM pegawai WHERE id_pegawai='".$_SESSION['id_pegawai']."'");
    $data=mysqli_fetch_assoc($login);
    ?>
    <body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <a class="fas fa-plus mr-3" href="barang.php">New Data</a> 
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="index.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="tables.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Tables
            </a>
        </nav>
        </a>
    </aside>

  

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Tables</h1>

                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Tabel Barang
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">ID BARANG</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">JENIS BARANG</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">MERK</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">STOK</td>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></td>
                                </tr>
                            </thead>
                            <tbody class="text-white-700">
                            <?php
                  require('koneksi.php');

                  if (isset($_GET['hlm'])) {
                              $hlm = $_GET['hlm'];
                              $no  = (30*$hlm) - 29;
                              if (isset($_SESSION['cari'])) {
                              $tampil = mysqli_query($koneksi,"SELECT * FROM barang WHERE id_barang LIKE '%".$_SESSION['cari']."%' or email LIKE '%".$_SESSION['cari']."%' ORDER BY id_barang DESC");
                                 echo "<b>Hasil Pencarian barang: ".$_SESSION['cari']."</b>";
                                 unset($_SESSION['cari']);
                              }else{
                              $tampil = mysqli_query($koneksi,"SELECT * FROM barang");  
                              }
                        } else {
                              $hlm = 1;
                              $no  = 1;
                        }
                  $start  = ($hlm - 1) * 30;

                  if (isset($_SESSION['cari'])) {
                     $sql = mysqli_query($koneksi, "SELECT * FROM barang  WHERE id_barang LIKE '%".$_SESSION['cari']."%' or id_barang LIKE '%".$_SESSION['cari']."%' LIMIT $start,30");
                     echo "<b>Hasil Pencarian barang : ".$_SESSION['cari']."</b>";
                     unset($_SESSION['cari']);
                  }else{
                     $sql = mysqli_query($koneksi, "SELECT * FROM barang  LIMIT $start,30");
                   }  
                  
                  if (mysqli_num_rows($sql) > 0) {

                  $i = 1;
                  while($data = mysqli_fetch_array($sql)) {
                        ?>
                    <tr
                        class="bg-white border-b dark:bg-white-800 dark:border-black-700 hover:bg-white-50 dark:hover:bg-white-600">
                        <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">
                            <?php echo $data['id_barang'] ?>
                        </td>
                        <td class="px-6 py-4">
                        <?php echo $data['jenis_barang'] ?>
                        </td>
                        <td class="px-6 py-4">
                        <?php echo $data['merk_barang'] ?>
                        </td>
                        <td class="px-6 py-4">
                        <?php echo $data['stock'] ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="delete.php?id_barang=<?php echo $data['id_barang'] ?>" class="mt-4 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Delete</a>
                            <a href="barang_edit.php?id_barang=<?php echo $data['id_barang'] ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                        </td>
                    </tr>
                
                    <?php
                            
                        }
                    } else {

                        echo "<tr>
                                <td colspan='4' style='text-align:center;'><h4>Belum ada data</h4></td>
                            </tr>";
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
    
</body>
    
</body>
                
</html>