<?php
UcitajSvePhp();


function UcitajSvePhp(){
	$obj=array();
	$id=$_GET['id'];
	include 'baza.php';
	$baza=Baza::connect();
	$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query='Select * from novosti where id=?';

	$q = $baza->prepare($query);
	$q->execute(array($id));
	$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
	$obj=array('id'=>$tmpObj['id'],'naslov'=>$tmpObj['tekst'],'tekst'=>$tmpObj['tekst'],'link'=>$tmpObj['linkSlike'],'datum'=>$tmpObj['datum'],'idAutor'=>$tmpObj['idAutor'],'komentari'=>$tmpObj['komentari'],'naslov'=>$tmpObj['naslov']);
	Baza::disconnect();

	Prikazi($obj);
}
function DajAutora($idAutora){
	$baza=Baza::connect();
	$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query='Select * from autori where id=?';
	$q = $baza->prepare($query);
	$q->execute(array($idAutora));
	$tmpObj = $q->fetch(PDO::FETCH_ASSOC);
	$obj=array('id'=>$tmpObj['id'],'ime'=>$tmpObj['ime'],'prezime'=>$tmpObj['prezime'],'username'=>$tmpObj['username'],'sifra'=>$tmpObj['sifra']);
	Baza::disconnect();
	return $obj["username"];
}

function Prikazi($lista){
	print '<div class="novostiDetalji"> 
		<h2>'.$lista["naslov"].'</h2>
		<div class="vrijemeDetalji"> Novost objavljena '.$lista["datum"].'.</div><div class="autorDetalji">Autor: <div id="link" onclick="OpenAutor('.$lista["idAutor"].')">'.DajAutora($lista["idAutor"]).'</div></div>
		<div class="novostDetalji">
			<img class="slikaNovostiDetalji" src="'.$lista["link"].'" alt="0"/>
			<p class="paragrafNovostiDetalji">'.$lista["tekst"].'</p>
			  <div class="dodajKomentar">';
			  
	if($lista["komentari"])	  
			print  '<input type="button" name="dodajKomentar" id="dodajKomentarBtn" value="Dodaj komentar" onclick="DodajKomentar('.$lista["id"].')"/>';
	print	'</div>
		</div>
		<div class="komentari">'.PrikaziKomentare($lista["id"],$lista["komentari"]).'
		</div>
	</div>';	
}

function PrikaziKomentare($id,$check){
	$div='';
	$baza=Baza::connect();
	$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query='Select * from komentari';
	$obj=array();
	foreach($baza->query($query) as $r){
		$tmpObj=array('id'=>$r['id'],'tekst'=>$r['tekst'],'datum'=>$r['datum'],'idNovosti'=>$r['idNovosti'],'nadimakAutora'=>$r['nadimakAutora'],'komentarNaKomentar'=>$r['komentarNaKomentar']);
		if($tmpObj["idNovosti"]==$id)
			array_push($obj,$tmpObj);
	}
	Baza::disconnect();
	if($check==1){
		for($i=0; $i<count($obj); $i++){
			if($obj[$i]["komentarNaKomentar"]==""){
				$TmpDiv= '<div class="komentar">
					<div class="kucicaZaglavljaKomentara">
						<div class="nadimakAutoraKomentara">'.$obj[$i]["nadimakAutora"].'</div>
						<div class="vrijemeKomentara">'.$obj[$i]["datum"].'</div>
					</div>
					<div class="tekstKomentara">'.$obj[$i]["tekst"].'</div>
					<div class="odgovoriDiv"> <input type="button" class="odgovoriBtn" onclick="KomentarNaKomentar('.$obj[$i]["id"].','.$obj[$i]["idNovosti"].')" name="odgovori" value="Odgovori"/> </div>
				</div>';
				
				$TmpDiv=$TmpDiv.provjeriKomentarNaKomentar($obj,$i,$obj[$i]["id"]);
				$div=$div.$TmpDiv;
			}
		}
	}
	return $div;
}

function provjeriKomentarNaKomentar($obj, $od, $id){
	$div='';
	for($i=$od; $i<count($obj); $i++){
		if($id==$obj[$i]["komentarNaKomentar"]){
			$TmpDiv= '<div style="left:100px; position:relative; width:87%" class="komentar">
						<div class="kucicaZaglavljaKomentara" style="width:20%">
							<div class="nadimakAutoraKomentara">'.$obj[$i]["nadimakAutora"].'</div>
							<div class="vrijemeKomentara">'.$obj[$i]["datum"].'</div>
						</div>
						<div class="tekstKomentara" style="width:78%">'.$obj[$i]["tekst"].'</div>
					</div>';
			$div=$div.$TmpDiv;
		}
	}
	return $div;
}
?>
<div id="formaObjavaKomentaraPocetna" ></div>
<style>

.novostiDetalji{
    width: 95%;
    display: inline-block;
    margin-left: 20px;
    border-radius: 5%;
    border: 1px solid gray;
    margin-top: 15px;
    background-color: rgba(15, 117, 56, 0.55);
}

.novostiDetalji h2{
	margin-left:auto;
	margin-right:auto;
	width:40%;
	margin-bottom: 10px;
    margin-top: 10px;
}

.vrijemeDetalji{
	font-size:12px;
	margin-left:5px;
	display:inline-block;
}

.autorDetalji{
	font-size:12px;
	margin-right:5px;
	display:inline-block;
	float:right;
}

#link{
	color:blue;
	cursor: pointer;
	display:inline-block;
}
.novostDetalji{
	padding: 5px;
}

.slikaNovostiDetalji{
	width:300px;
	height:200px;
	display:inline-block;
	border-radius: 15%;
	vertical-align:top;
}

.paragrafNovostiDetalji{
	display:inline-block;
	width:60%;
	margin-left:5px;
    font-size: 100%;
	margin-top: -5px;
	font-size:15px;
	font-family:'Lora';
	font-style:italic;
}

.komentari{
	width: 99%;

}
.komentar{
	width:99%;
	height: 50px;
	background-color: rgba(50, 89, 49, 0.57);
    border-radius: 11%;
    margin: 10px;	
}
.kucicaZaglavljaKomentara{
	display: inline-block;
    height: 100%;
    width: 20%;
    background-color: rgba(230, 255, 219, 0.66);
    border-top-left-radius: 15%;
    border-bottom-left-radius: 15%;
}
.tekstKomentara{
	display: inline-block;
    height: 100%;
    width: 68%;
    background-color: rgba(226, 255, 245, 0.57);
    border-top-right-radius: 10%;
    border-bottom-right-radius: 10%;
    position: relative;
    top: -25px;
    padding-left: 4px;
}
.nadimakAutoraKomentara{
	width: 100%;
    height: 49%;
    border-bottom: 1px solid green;
	padding-left: 10px;
}
.vrijemeKomentara{
	width: 100%;
    height: 50%;
    padding-left: 10px;
}

.odgovoriDiv{
	display:inline-block;
	padding: 10px;
    float: right;
}

.dodajKomentar{
	position: relative;
    left: 86%;
	border-radius:10%;
}

#formaObjavaKomentaraPocetna{
	display:none;
	position: absolute;
    width: 305px;
    height: 240px;
    top: 35px;
    left: 44%;
    background-color: #8AF390;
    padding: 10px;
    border-radius: 5%;
}
#komentar{
	max-height:75px;
	max-width:297px;
}

#btnPonistiObjavuKomentara{
	display:inline-block;
	float:left;
	margin-top: 10px;
}

#btnObjaviKomentar{
	display:inline-block;
	float:right;
	margin-top: 10px;
}

.odgovoriBtn{
	border-radius:10%;
    background-color: #9FEDE4;
}
#dodajKomentarBtn{
	width:115px;
	height:50px;
}
</style>