<?php
require_once 'config.php'; // Pastikan jalur ini sesuai dengan struktur proyek Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    $sql = "INSERT INTO user (nama, username, password, role_id) VALUES ('$name', '$username', '$password', '$role_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal! Silakan coba lagi.'); window.location.href='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA Compatible" content="ie=edge">
	<title>Mardah</title>

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

		*{
			box-sizing: border-box;
			margin: 0; 
		}
		body{
			scroll-behavior: smooth;
			font-family: "Merriweather", serif;
			background: #E5E5E5;
			overflow:hidden;
		}
		h1,h5{
			font-style: normal;
			font-weight: 500;
			line-height: 116%;
			color: #333333;
			margin-top: 3%;
		}
		h1{
			font-size: 1.8rem;
			margin-bottom: 20px;
		}
		.container {
		  display: flex;
		  height: 100vh;
		}

		.form-container {
		  flex: 1;
		  display: flex;
		  flex-direction: column;
		  justify-content: center;
		  align-items: center;
		  padding: 20px;
		  background-color: white;
		}

		form {
		  display: flex;
		  flex-direction: column;
		  width: 90%;
		  max-width: 400px;
		}
		label {
		  margin-bottom: 10px;
		}

		input, button, select {
		  	width:100%;
			padding:10px 10px;
			margin:8px 0;
			font-size:14px;
			box-sizing:border-box;
		}

		.image-container {
		  flex: 1.5;
		  background-image: url("images/logo.png");
		  background-color: red;
		  background-size: cover;
		  background-position: center;
		}
		button{
		  color: white; /* White text color */
		  padding: 10px 20px; /* Add some padding */
		  border: none; /* Remove the border */
		  border-radius: 5px; /* Add some border-radius */
		  cursor: pointer; /* Add a pointer cursor on hover */
		  transition: background-color 0.3s ease-in-out; /* Add a transition effect */
		}

		.grad-btn:hover {
		  background: linear-gradient(to right, #3786e8, #23b3e8); /* Darker gradient background color on hover */
		}
		@media screen(max-width: 768px){
			overflow-y: hidden;
		}
	</style>
</head>
<body>		
	<div class="container">
	    <div class="image-container"></div>
	    <div class="form-container">
	      <header><center><h1>SIGN UP TO WAROENGKU</h1></center></header><hr>
	      <form method="POST">
	      	<input type="text" name="name" placeholder="Masukkan nama lengkap anda.." required>
	      	<input type="text" name="username" placeholder="Masukkan username anda.." required>
	        <input type="password" name="password" placeholder="Password" required>
	        
	        <select name="role_id">
	        	<?php
                require_once 'config.php';
                $role_query = "SELECT * FROM role";
                $role_result = mysqli_query($conn, $role_query);
                while ($role_row = mysqli_fetch_assoc($role_result)) {
                	?>
	        	<option value="<?= $role_row['id']?>"><?= $role_row['level']; }?></option>
	        </select>
	        <button type="submit" style="background-color: #4CAF50;color: white;border:none;margin-top:15px; padding:14px;cursor: pointer; font-weight: bold;">REGISTER</button>
	 		<center>
	 			<h5><a href="login.php" style="text-decoration: none;">Sudah punya akun? Login sekarang</a></h5>
	 			<h5><a href="index.html" style="text-decoration: none;">Kembali ke beranda</a></h5>
	 		</center>
	      </form>
	    </div>
	</div>
</body>
</html>
