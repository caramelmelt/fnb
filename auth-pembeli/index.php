<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function resetCart() {
    $_SESSION['cart'] = [];
}

function addToCart($productId, $productName, $price) {
    $_SESSION['cart'][] = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $price
    );
}

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    addToCart($productId, $productName, $price);
}

$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'];
}

if (isset($_POST['buat_pesanan'])) {
    $cart = $_SESSION['cart'];
    $id_user = $_POST['id'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $pengiriman = $_POST['pengiriman'];

    $insertQuery = "INSERT INTO pemesanan (user_id, katalog_id, jumlah, alamat, tanggal, pengiriman, status) VALUES ";

    foreach ($cart as $item) {
        $productId = $item['id'];
        $jumlah = 1;
        $status = "Menunggu Konfirmasi";

        $insertQuery .= "('$id_user', '$productId', '$jumlah', '$alamat', '$tanggal', '$pengiriman', '$status'), ";
    }

    $insertQuery = rtrim($insertQuery, ', ');
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        echo "<script>alert('Pemesanan berhasil dibuat!');</script>";
        header('Location: pesanan.php');
        exit; 
    } else {
        echo "<script>alert('Pemesanan gagal dibuat!');</script>";
        header('Location: index.php');
        exit; 
    }

    resetCart();
}


//Reset cart
if (isset($_POST['reset_cart'])) {
    resetCart();
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
	<title>Waroengku</title>
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
						<a href="index.php">HOME</a>
					</li>

					<li>
						<a href="pesanan.php">PESANAN SAYA</a>
					</li>

					<li>
						<form action="../logout.php" method="post">
		    				<button type="submit" style="all:unset;" name="logout">LOGOUT</button>
						</form>
					</li>
					</li>
				</ul>
				<button class="toggle">=</button>
			</nav>
		</div>
	</div>

	<header><center><h1>Produk Kami</h1></center></header>
			<div class="product-grid" id="produk">
	    <?php
	    require_once('../config.php');
	    $sql = "SELECT * FROM katalog";
	    $result = $conn->query($sql);

	    if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
	    ?>
	            <div class="product-item">
	                <img src="../images/<?= $row['gambar'] ?>" alt="Gambar <?= $row['katalog']?>">
	                <h3><?= $row['katalog'] ?></h3>
	                <p><b>Rp<?= number_format($row['harga'], 0, ',', '.') ?></b></p>
	                <form method="post">
			            <input type="hidden" name="product_id" value="<?= $row['id']?>">
			            <input type="hidden" name="product_name" value="<?= $row['katalog']?>">
			            <input type="hidden" name="price" value="<?= $row['harga']?>">
			            <button type="submit" class="btn" name="add_to_cart">Masukkan Keranjang</button>
			        </form>

	            </div>
	    <?php
	        }
	    } else {
	        echo "0 results";
	    }
	    $conn->close();
	    ?>
	</div>

			  <!-- Tambahkan lebih banyak elemen .product-item sesuai kebutuhan -->
		<div class="boxcart">
			<div id="cart">
				<h1><center>Shopping Cart</center></h1><hr><br>
				<div class="total"></div>
			</div>
			<div id="btn-container">
				<h2>Keranjang Belanja</h2>
				<ul>
				    <?php 
				    $totalPrice = 0;
				    foreach ($_SESSION['cart'] as $item):
				    $totalPrice += $item['price'];
				    ?>
				        <li><?= $item['name'] ?> - Rp<?= number_format($item['price'], 0, ',', '.') ?></li>
				    <?php endforeach; ?>
				</ul>
				<hr>
				<h5>Total Harga: Rp<?= isset($totalPrice) ? number_format($totalPrice, 0, ',', '.') : '0' ?></h5>


				<!-- Button untuk memunculkan modal -->
			<div class="btn-cart">
				<button id="cartButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartModal">Checkout</button>
				<form method="post">
				    <button type="submit" class="btn" name="reset_cart">Reset Keranjang</button>
				</form>
			</div>
		</div>

		<!-- Modal keranjang -->
		<div id="cartModal" class="modal fade" tabindex="-1" role="dialog">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Pengiriman</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" id="cartModalBody">
		      	<form method="POST">
		        <div class="checkout-info">
		          <div class="form-group">
		            <label for="fullName">Nama Lengkap</label>
		            <input type="hidden" name="id" class="form-control" value="<?= $_SESSION['id'];?>">
		            <input type="text" class="form-control" id="fullName" value="<?= $_SESSION['nama'];?>" readonly>
		          </div>
		          <div class="form-group">
		            <label for="alamat">Alamat</label>
		            <textarea class="form-control" name="alamat" rows="3" required placeholder="Masukkan Alamat Anda"></textarea>
		          </div>
		          <div class="form-group">
		            <label for="tanggal">Tanggal</label>
		            <input type="date" class="form-control" name="tanggal" rows="3"  value="<?= date('Y-m-d') ?>" required>
		          </div>
		        </div>

		        <!-- Opsi Pengiriman -->
		        <div class="form-group">
		          <label for="shippingOption">Opsi Pengiriman</label>
		          <select class="form-control" name="pengiriman" id="shippingOption">
		            <option value="Pengiriman">Pengiriman</option>
		            <option value="Pengambilan">Pengambilan/Ambil Sendiri</option>
		          </select>
		        </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="buat_pesanan" class="btn btn-primary">Buat Pesanan</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>

		</div>

		</div>

		<div class="thumbnail">
			<img src="../images/logo.png" alt="Produk Mardah">
			<h1 style="text-align: center;">WAROENGKU <br><br> Enak, murah, maknyus!</h1>
		</div>

		<footer>
			<div class="abt">
				<h2>ABOUT WAROENGKU</h2><br>
				<p>Jalan Swadarma Raya Kampung Baru IV No. 1 Jakarta</p>
				<p>12250 Indonesia</p>
				<p>Fax +62 21 585 2439</p>
			</div>
				<div class="payment">
					<h2>PAYMENT</h2><br>
					<img src="../images/bank.png">
					<img src="../images/linkaja.png"><br>
					<img src="../images/gopay.png">
					<img src="../images/ovo.png">
					<img src="../images/dana.png">

				</div>
				<div class="coprig">
					<small>&copy;Copyright 2024 | Waroengku</small>
				</div>
		</footer>
	</div>
</body>

<script src="cart.js"></script>
<script type="text/javascript">
	const toggle = document.querySelector('.toggle');
const menu = document.querySelector('.menubar');

toggle.addEventListener('click', () => {
  menu.classList.toggle('open');
});

document.addEventListener("DOMContentLoaded", function() {
    var cartSection = document.getElementById("cart");
    if (cartSection) {
        cartSection.scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

</html>
