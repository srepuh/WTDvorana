<!DOCTYPE html>
	<head>
		<title>Dvorana R&S - Linkovi </title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="../stilovi/stil.css"/>
		<script src="../js/Main.js"></script>
	</head>
	<body>
<?php
include 'login.php';
?>
	<div id="vrh"></div>
		<header>
			<nav>
				<ul>
					<li id="logoLi"><div id="logo"><div id="logoTeren"></div><div id="logoText"><strong>Gym R&S</strong></div><div id="logoLopta"></div></div></li>
					<li><a href="../index.php"><h3>Početna</h3></a></li>
					<li><a href="ONama.php"><h3>O nama</h3></a></li>
					<li><a href="Kontakt.php"><h3>Kontakt</h3></a></li>
					<li><a href="Linkovi.php"><h3>Linkovi</h3></a></li>
					<?php if ($_SESSION['loginFormVisible']==='true')
						{?>
							<li onclick="Login()"><a href="#"><h3>Login</h3></a></li>
						<?php 
						}else{ 
						?>
							<li onclick="Logout()"><a href="#"><h3>Logout</h3></a></li>
						<?php 
						}
						?>					 

				</ul>
			</nav>
		</header>
		<div id="body">
			<div class="container">
				<ul id="linkovi">
					<li><a href="http://sportsport.ba/" target="_blank">SportSport</a></li>
					<li><a href="http://www.reprezentacija.ba/" target="_blank">Reprezentacija</a></li>
					<li><a href="http://www.w3schools.com/" target="_blank">W3Cchools</a></li>
					<li><a href="http://www.google.ba/" target="_blank">Google</a></li>
				</ul>
			</div>
		</div>
		<div id="footer">
			<div id="foot">All credits by Repuh Šahin</div>
		</div>
	</body>
</html>