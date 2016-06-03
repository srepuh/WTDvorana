<!DOCTYPE html>
	<head>
		<title>Dvorana R&S </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../stilovi/stil.css">
		<script src="../js/Index.js"></script>
		<script src="../js/Main.js"></script>
	</head>
	<body>
<?php
include 'login.php';	
if(isset($_GET['filterPHP']))
	$idFiltera = $_GET['filterPHP']?:'';
else{
	$idFiltera=0;
}

function UcitajSvePhp(){
	$obj=array();
	$id=$_GET['id'];
	include 'baza.php';
	$baza=Baza::connect();
	$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query='Select * from novosti';
	foreach($baza->query($query) as $r){
		$tmpObj=array('id'=>$r['id'],'naslov'=>$r['naslov'],'tekst'=>$r['tekst'],'link'=>$r['linkSlike'],'datum'=>$r['datum'],'idAutor'=>$r['idAutor'],'komentari'=>$r['komentari']);
		if($tmpObj["idAutor"]==$id)
			array_push($obj,$tmpObj);
	}
	Baza::disconnect();

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
	if(count($list)!=0){
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
	}
	return $list;
}

function Prikazi($lista){
	for($i=0; $i<count($lista); $i++){
		if($i%2==0)
			print '<div class="novostiLijevo" onclick="OtvoriNovost('.$lista[$i]["id"].',false)"> 
				<h4>'.$lista[$i]["naslov"].'</h4>
				<div class="vrijeme"> Novost objavljena <time class="vrijemeObjave" datetime="'.$lista[$i]["datum"].'"> </time>.</div>
				<div class="novost">
					<img class="slikaNovosti" src="'.$lista[$i]["link"].'" alt="'.$i.'"/>
					<p class="paragrafNovosti">'.$lista[$i]["tekst"].'</p>
				</div>
			</div>';	
		else{
			print '<div class="novostiDesno" onclick="OtvoriNovost('.$lista[$i]["id"].',false)"> 
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
		<?php
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			echo '<input type="hidden" value="'.$id.'" name="id" />';
		}
		?>
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
	<?php
	UcitajSvePhp();

	?>	
</div>
<div id="objavljivanjeNovosti"></div>

		</div>
		<div id="footer">
			<div id="foot">All credits by Repuh Šahin</div>
		</div>
		
	</body>
</html>