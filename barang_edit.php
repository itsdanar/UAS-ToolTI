<?php
    include("koneksi.php");

$id = $_GET['id_barang'];
$get = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
$data = mysqli_fetch_array($get);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">


<div class="py-4 px-4 w-full">
    <form class="w-full py-4 px-4 bg-white rounded-md" action="" method="post" enctype="multipart/form-data">
        <div class="grid gap-6 py-4 mb-6 md:grid-cols-1">
            <input type="hidden" value="<?php echo $id ?>" name="id_barang">
        <div class="mb-6">
            <label for="jenis_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Jenis Barang</label>
            <input type="text" name="jenis_barang" value="<?php echo $data['jenis_barang'] ?>" id="jenis_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Jenis Barang" required>
        </div> 
        <div class="mb-6">
            <label for="merk_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Merk Barang</label>
            <input type="text" name="merk_barang" value="<?php echo $data['merk_barang'] ?>" id="merk_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Merk Barang" required>
        </div> 
        <div class="mb-6">
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Stock Barang</label>
            <input type="number" name="stock" id="stock" value="<?php echo $data['stock']?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Jumlah Stok Barang" required>
        </div> 
        </div>
        <div class ="grid grid-cols-1 justify-between items-center">
        <button type="submit" name="update" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <button type="button" onclick="window.history.back()" class="mt-4 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">Back</button>
        </div>
    </form>
</div>

<?php
    include("koneksi.php");
  if(isset($_POST['update'])){
    $id_barang = $_POST['id_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $merk_barang = $_POST['merk_barang'];
    $stock = $_POST['stock'];


        $update = mysqli_query($koneksi, "UPDATE barang SET jenis_barang='". $jenis_barang ."', merk_barang='". $merk_barang ."', stock='". $stock ."' WHERE id_barang='". $id_barang ."'");
        if(!$update){
            echo '<script>
            alert("Error update");
          </script>
          ';
        }
      echo '
        <script>
          alert("Berhasil Mengupdate Data Barang");
          window.location="tables.php";
        </script>
        ';
    }
    
?>
</body>
</html>