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
					<img style="width: 40px;" src="images/logo.png">
					<span>WAROENG KU</span>
				</div>

				<ul class="menubar">
					<li>
						<a href="index.html">HOME</a>
					</li>

					<li>
						<a href="shop.php">MENU</a>
					</li>

					<li>
						<a href="#abtus">ABOUT US</a>
					</li>

					<li>
						<a href="login.php" target='_blank' id="btn-register">Login</a>
					</li>
				</ul>
				<button class="toggle">=</button>
			</nav>
		</div>
	</div>

	<header><center><h1>Produk Kami</h1></center></header>
		<div class="product-grid" id="produk">
		    <?php
		    require_once('config.php');
		    $sql = "SELECT * FROM katalog";
		    $result = $conn->query($sql);

		    if ($result->num_rows > 0) {
		        while($row = $result->fetch_assoc()) {
		    ?>
		            <div class="product-item">
		                <img src="images/<?= $row['gambar'] ?>" alt="Gambar <?= $row['katalog']?>">
		                <h3><?= $row['katalog'] ?></h3>
		                <p><b>Rp<?= number_format($row['harga'], 0, ',', '.') ?></b></p>
		                <form method="post">
				            <input type="hidden" name="product_id" value="<?= $row['id']?>">
				            <input type="hidden" name="product_name" value="<?= $row['katalog']?>">
				            <input type="hidden" name="price" value="<?= $row['harga']?>">
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

		<div class="thumbnail">
			<img src="images/logo.png" alt="Produk Mardah">
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
					<img src="images/bank.png">
					<img src="images/linkaja.png"><br>
					<img src="images/gopay.png">
					<img src="images/ovo.png">
					<img src="images/dana.png">

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
</script>

</html>
