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

	<header><center><h1>KATALOG MENU</h1></center></header>
			<div class="col-md-12 mt-4 mb-5 ">
			    <div class="table-responsive tbl-pesanan">
				<a href="add_product.php" class="btn btn-primary mb-3">Tambah Katalog</a>
                <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Gambar</th>
                          <th scope="col">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php 
                  require_once '../config.php';

                  $query = "SELECT * FROM katalog";
                  $result = mysqli_query($conn, $query);

                  if ($result) {
                      $no = 1;
                      foreach ($result as $row) {
                      	?>
                      <tr>
                          <th scope="row"><?= $no++ ?></th>
						  <td><?= $row['katalog']; ?></td>
                          <td><?= $row['harga']; ?></td>
                          <td><?= $row['gambar']; ?></td>
	                       <td>
                                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</a>
                            </td>
                      </tr>
                  <?php 
                      }
                  } else {
                      echo "<tr><td colspan='6'>Terjadi kesalahan dalam mengambil data dari database.</td></tr>";
                  }
                  ?>
                  </tbody>
              </table>
          </div>
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
</script>

</html>
