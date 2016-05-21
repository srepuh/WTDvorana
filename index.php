<!DOCTYPE html>
	<head>
		<title>Dvorana R&S </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="stilovi/stil.css">
		<script src="js/Index.js"></script>
		<script src="js/Main.js"></script>
	</head>
	<body>
<?php
include 'stranice/login.php';	
if(isset($_GET['filterPHP']))
	$idFiltera = $_GET['filterPHP']?:'';
else{
	$idFiltera=0;
}
function UcitajSvePhp(){
	$redovi=file("novosti.csv");
	$obj=array();
	foreach($redovi as $r){
		$celije=explode(',',$r);
		$tmpDatum=$celije[3]."+02:00";
		$tmpObj=array('naslov'=>str_replace(";.?",",",$celije[0]),'tekst'=>str_replace(";.?",",",$celije[2]),'link'=>$celije[1],'datum'=>$tmpDatum);
		array_push($obj,$tmpObj);
	}
	if(isset($_GET['filterPHP']))
		$idFiltera = $_GET['filterPHP']?:'';
	else{
		$idFiltera=0;
	}
	
	if($idFiltera==0){
		$obj=order($obj,"opadajuci","datum");			
	}else if($idFiltera==1){
		$obj=order($obj,"opadajuci","naslov");						
	}else if($idFiltera==2){
		$obj=order($obj,"rastuci","naslov");			
	}
	Prikazi($obj);
}

function order($list,$tip,$po){
	foreach ($list as $key => $row) {
		$naslov[$key]  = $row['naslov'];
		$datum[$key]  = $row['datum'];
	}

	if($tip=="rastuci"){
		if($po=="naslov")
			array_multisort($naslov, SORT_ASC, $list);
		else if($po=="datum"){
			array_multisort($datum, SORT_ASC, $list);	
		}
	}else if($tip=="opadajuci"){
		if($po=="naslov")
			array_multisort($naslov, SORT_DESC, $list);
		else if($po=="datum"){
			array_multisort($datum, SORT_DESC, $list);	
		}
	}
	return $list;
}

function Prikazi($lista){
	for($i=0; $i<count($lista); $i++){
		if($i%2==0)
			print '<div class="novostiLijevo"> 
				<h4>'.$lista[$i]["naslov"].'</h4>
				<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="'.$lista[$i]["datum"].'"> </time>.</div>
				<div class="novost">
					<img class="slikaNovosti" src="'.$lista[$i]["link"].'" alt="'.$i.'"/>
					<p class="paragrafNovosti">'.$lista[$i]["tekst"].'</p>
				</div>
			</div>';	
		else{
			print '<div class="novostiDesno"> 
				<h4>'.$lista[$i]["naslov"].'</h4>
				<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="'.$lista[$i]["datum"].'"> </time>.</div>
				<div class="novost">
					<img class="slikaNovosti" src="'.$lista[$i]["link"].'" alt="'.$i.'"/>
					<p class="paragrafNovosti">'.$lista[$i]["tekst"].'</p>
				</div>
			</div>';			
		}
	}
}


?>
		<div id="vrh"></div>
		<header>
			<nav>
				<ul>
					<li id="logoLi"><div id="logo"><div id="logoTeren"></div><div id="logoText"><strong>Gym R&S</strong></div><div id="logoLopta"></div></div></li>
					<li><a href="#"><h3>Početna</h3></a></li>
					<li><a href="stranice/ONama.php"><h3>O nama</h3></a></li>
					<li><a href="stranice/Kontakt.php"><h3>Kontakt</h3></a></li>
					<li><a href="stranice/Linkovi.php"><h3>Linkovi</h3></a></li>				 
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
			
	<?php if ($_SESSION['loginFormVisible']==='true'){
	?><div id="postaviNovu">
		<input type="button" value="Objavi novost" onclick="OtvoriProzorZaNovost()">
	</div><?php
	}else{?>
	<div id="postaviNovuVisible">
		<input type="button" value="Objavi novost" onclick="OtvoriProzorZaNovost()">
	</div>	
	<?php } ?>
<div class="container">
	<div id="filterDiv">
		<select id="filter" onchange="Filtriraj()">
			<option value="0">Sve novosti</option>
			<option value="1">Današnje novosti</option>
			<option value="2">Sedmične novosti</option>
			<option value="3">Mjesečne novosti</option>
		</select>
		<form id="filterPHPForm">
		<select  name="filterPHP" onchange="this.form.submit();">
		<?php 
			if($idFiltera==0) echo '<option selected="selected" value="0">Po datumu</option>';
			else echo '<option value="0">Po datumu</option>';
			if($idFiltera==1) echo '<option selected="selected" value="1">Abecedno opadajuci</option>';
			else echo '<option value="1">Abecedno opadajuci</option>';
		    if($idFiltera==2) echo '<option selected="selected" value="2">Abecedno rastuci</option>';
			else echo '<option value="2">Abecedno rastuci</option>';
			?>
		</select>
		</form>
		<br>
	</div>
<!--	<div class="novostiLijevo"> 
		<h4>Najbolji tereni</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-04-01T16:28:00"> </time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/izgled1.jpg" alt="Slika terena"/>
			<p class="paragrafNovosti">Plastična trava proizvedena u Njemačkoj i održavana od strane Njemačke firme je jedan od naših najvećih aduta.</p>
		</div>
	</div>
	<div class="novostiDesno"> 
		<h4>Najkvalitetnije lopte</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-04-01T16:26:00">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/lopte.jpg" alt="Slika lopti" />
			<p class="paragrafNovosti">Od sada vam nudimo najbolje lopte od najpoznatijih proizvođača kao što su Adidas i Nike.</p>
		</div>
	</div>
	<div class="novostiLijevo"> 
		<h4>Najbolji golovi</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-28T20:49:00">vrijeme</time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/golovi.jpg" alt="Slika golova"/>
			<p class="paragrafNovosti">Aluminijski golovi sa nepoderivom mrežicom će vaš ugođaj dovesti na sasvim novi nivo.</p>
		</div>
	</div>
	<div class="novostiDesno"> 
		<h4>Novi markeri</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-26T13:25:03">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/markeri.jpg" alt="Slika markera" />
			<p class="paragrafNovosti">Kao najboolji domaćini nudimo vam i besplatne markere da biste mogli lakše prepoznati svoje saigrače.</p>
		</div>
	</div>
	<div class="novostiLijevo"> 
		<h4>Malonogometni turnir</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-25T19:49:00">vrijeme</time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/turnir1.jpg" alt="Slika golova"/>
			<p class="paragrafNovosti">Ovog mjeseca u našoj dvorani će se održati malonogometni turnir Asim Ferhatović Hase.</p>
		</div>
	</div>
	<div class="novostiDesno"> 
		<h4>Pobjednici turnira</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-15T13:25:03">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/osvajaciTurnira.jpg" alt="Slika markera" />
			<p class="paragrafNovosti">Ove godine osvajac tradicionalnog turnira Asim Ferhatović Hase je ekipa "Crvena Furija".</p>
		</div>
	</div>
	<div class="novostiLijevo"> 
		<h4>Nove lopte</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-05T10:50:00">vrijeme</time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/nekaLopta.jpg" alt="Slika lopte"/>
			<p class="paragrafNovosti">Dvorana R&S je dobila nove lopte od našeg poslovnog partnera Adidasa, dođite i oprobajte ih.</p>
		</div>
	</div>
	<div class="novostiDesno"> 
		<h4>R&S sponzor WC2014</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-03-01T13:25:03">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/brazil2014.jpg" alt="Slika brazila" />
			<p class="paragrafNovosti">Naša dvorana je generalni sponzor predstojećeg prventsva u Brazilu World Cup 2014.</p>
		</div>
	</div>
	<div class="novostiLijevo"> 
		<h4>Bajramski turnir</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2016-02-25T18:25:03">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/bajramskiTurnir.png" alt="Slika markera" />
			<p class="paragrafNovosti">Pred kraj tekuće sedmice bit će održan tradiconalni malonogometni bajramski turnir. Učešće je besplatno</p>
		</div>
	</div>
	<div class="novostiDesno"> 
		<h4>Pobjednici siromašnim</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2015-12-20T10:49:00">vrijeme</time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/osvajaciBajramskogTurnira.jpg" alt="Slika golova"/>
			<p class="paragrafNovosti">Ove godine sve ekipe su odlučile osvojene nagrade pokloniti siromašnim i uljepšati im praznike.</p>
		</div>
	</div>
	<div class="novostiLijevo"> 
		<h4>Turnir reintegracije</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2014-03-28T19:49:00">vrijeme</time>.</div>
		<div class="novost">
			<img class="slikaNovosti" src="slike/turnir2.jpg" alt="Slika golova"/>
			<p class="paragrafNovosti">Turnir reintegracije će se održati ovog vikenda u R&S dvorani. Obavezno dođite!</p>
		</div>
	</div>

	<div class="novostiDesno"> 
		<h4>Pobjednik turnira</h4>
		<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="2014-11-05T13:25:03">vrijeme</time>.</div>
		<div class="novost"> 
			<img class="slikaNovosti" src="slike/osvajaciDrugogTurnira.jpg" alt="Slika markera" />
			<p class="paragrafNovosti">Osvajač turnira reintegracije je prošlogodišnji pobjednik, ekipa "Bosna".</p>
		</div>
	</div>-->
	<?php UcitajSvePhp(); ?>
</div>
<div id="objavljivanjeNovosti"></div>

		</div>
		<div id="footer">
			<div id="foot">All credits by Repuh Šahin</div>
		</div>
		
	</body>
</html>