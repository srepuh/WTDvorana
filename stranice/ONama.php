<!DOCTYPE html>
	<head>
		<title>Dvorana R&S - O nama </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../stilovi/stil.css">
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
				<br/>
				<table>
					<caption><h4>Satnica</h4></caption>
					<tr class="prviR">
						<td class="prvaK">
						X
						</td>
						<td>
							Ponedjeljak
						</td>
						<td>
							Utorak
						</td>
						<td>
							Srijeda
						</td>
						<td>
							Četvrtak
						</td>
						<td>
							Petak
						</td>
						<td>
							Subota
						</td>
						<td>
							Nedjelja
						</td>
					</tr>
					<tr class="neparni">
						<td class="prvaK">
						08-12
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Trening
						</td>
						<td>
						Trening
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Turnir
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
					</tr>
					<tr  class="parni">
						<td class="prvaK">
						12-16
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Trening
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Trening
						</td>
						<td>
						Turnir
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
					</tr>
					<tr  class="neparni">
						<td class="prvaK">
						16-20
						</td>
						<td>
						Trening
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Trening
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Turnir
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
					</tr>
					<tr  class="parni">
						<td class="prvaK">
						20-24
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
						<td>
						Slobodno
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div id="footer">
			<div id="foot">All credits by Repuh Šahin</div>
		</div>
	</body>
</html>