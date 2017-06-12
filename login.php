<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: index.php');
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>GMS | Login Page</title>
      <link rel="icon" href="img/icon.png">
      <link rel="stylesheet" href="css/login.css">
</head>

<body>
<div class="container">
	<section id="content">
		<form action="logincek.php" method=POST>
			<h1>GMS | Login </h1>
      <?php if(isset($_GET['pesan'])){
          echo "<h3>Username & Password Salah</h3>";
      }
      ?>
			<div>
				<input type="text" placeholder="Username" name='username' required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" name='pass' required="" id="pass" />
			</div>
			<div>
				<input type="submit" value="Log in" />
				<!-- <a href="#">Lost your password?</a>
				<a href="#">Register</a> -->
			</div>
		</form><!-- form -->
		<div class="button">
			<!-- <a href="#">Download source file</a> -->
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
