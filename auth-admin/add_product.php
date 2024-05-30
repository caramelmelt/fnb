<?php
require_once '../config.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $query = "INSERT INTO katalog (katalog, harga, gambar) VALUES ('$name', '$price', '$image')";
    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil ditambahkan.";
        header('Location: katalog.php'); // Sesuaikan dengan halaman manajemen produk Anda
    } else {
        echo "Gagal menambahkan produk: " . mysqli_error($conn);
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

	<header><center><h1>TAMBAH KATALOG</h1></center></header>
			<div class="container mt-5">
		    <form method="POST">
		        <div class="form-group">
		            <label for="name">Nama Produk</label>
		            <input type="text" class="form-control" name="name" placeholder="Cth: Cireng Ayam" required>
		        </div>
		        <div class="form-group">
		            <label for="price">Harga</label>
		            <input type="number" class="form-control" name="price" placeholder="Cth: 19000" required>
		        </div>
		        <div class="form-group">
		            <label for="image">Gambar</label>
		            <input type="text" class="form-control" name="image" placeholder="Cth: contoh-gambar.webp">
		        </div>
		        <button type="submit" name="add" class="btn btn-success">Tambah</button>
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
