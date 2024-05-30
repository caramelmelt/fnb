<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Pastikan id di-cast ke integer untuk keamanan
    $query = "SELECT * FROM katalog WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $query = "UPDATE katalog SET katalog = '$name', harga = '$price', `gambar` = '$image' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil diperbarui.";
        header('Location: katalog.php'); // Sesuaikan dengan halaman manajemen produk Anda
    } else {
        echo "Gagal memperbarui produk: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Memuat library jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Memuat library Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Mardah</title>
</head>
<body>

	<div class="nav-container">
		<div class="wrapper">
			<nav>
				<div class="logo">
					<img style="width: 40px;" src="../images/logo.png">
					<span>WAROENG KU</span>
				</div>

				<ul class="menubar">
					<li>
						<a href="index.php">PESANAN</a>
					</li>

					<li>
						<a href="katalog.php">KATALOG</a>
					</li>

					<li>
						<form action="../logout.php" method="post">
		    				<button type="submit" style="all:unset;" name="logout">LOGOUT</button>
						</form>
					</li>
				</ul>
				<button class="toggle">=</button>
			</nav>
		</div>
	</div>

	<header><center><h1>EDIT KATALOG</h1></center></header>
		<div class="container mt-5">
	    <form method="POST">
	        <input type="hidden" name="id" value="<?= $product['id'] ?>">
	        <div class="form-group">
	            <label for="name">Nama Produk</label>
	            <input type="text" class="form-control" name="name" value="<?= $product['katalog'] ?>" required>
	        </div>
	        <div class="form-group">
	            <label for="price">Harga</label>
	            <input type="number" class="form-control" name="price" value="<?= $product['harga'] ?>" required>
	        </div>
	        <div class="form-group">
	            <label for="image">Gambar</label>
	            <input type="text" class="form-control" name="image" value="<?= $product['gambar'] ?>" required>
	        </div>
	        <button type="submit" name="update" class="btn btn-success">Update</button>
	        <a href="katalog.php" class="btn btn-secondary">Kembali</a>
	    </form>
	</div>
</body>

<script src="cart.js"></script>
<script type="text/javascript">
	const toggle = document.querySelector('.toggle');
const menu = document.querySelector('.menubar');

toggle.addEventListener('click', () => {
  menu.classList.toggle('open');
});
</script>

</html>
