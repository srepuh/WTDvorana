<!DOCTYPE html>
	<head>
		<title>Dvorana R&S - Kontakt </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../stilovi/stil.css">
		<script src="../js/Validacija.js"></script>
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
				<div id="forma">
					<h4>Kontakt:</h4>
					<div id="unutrasnjaForma">
						<div id="ImeDiv"> 
							<label>Ime i prezime:</label>
							<input id="tbIme" type="text" oninput="ValidirajImeIprezime(this)" placeholder="Unesi ime i prezime"/>
						</div>
						<div id="TelDiv"> 
							<label>Telefon:</label>
							<input id="tbTel" type="tel" oninput="ValidirajTelefon(this)"  placeholder="Unesi telefon"/>
						</div>
						<div id="EmailDiv"> 
							<label>Email:</label>
							<input id="tbEmail" type="email" oninput="ValidirajEmail(this)" placeholder="Unesi email"/>
						</div>
						<div id="GodinaDiv"> 
							<label>Godina rodjenja:</label>
							<input id="tbGodina" type="number" oninput="ValidirajGodinu(this)" value="1992"/>
						</div>
					</div>
					<div id="SubmitDiv">
						<input id="btnSumbit" type="button" value="Submit"/>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div id="foot">All credits by Repuh Šahin</div>
		</div>
	</body>
</html>