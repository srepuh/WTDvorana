<?php
	$greska="";
	$uspjeh="";
	if( $_SERVER["REQUEST_METHOD"] == "POST" ){
		$naslov=htmlspecialchars($_REQUEST['naslov']);
		$tekst=htmlspecialchars($_POST['tekstualno']);
		$slika=htmlspecialchars($_REQUEST['linkSlike']);
		$today =date("Y-m-d H:i:s"); 
		$idAutor=1;//TREBA SREDITI DOBAVLJANJE AUTORA
		$komentari=false;
		if(isset($_POST['komentari'])){
			$komentari=true;
		}
		if(!empty($_POST['naslov']) && !empty($_POST['tekstualno']) && !empty($_POST['linkSlike'])){
			$naslov=$_POST['naslov'];
			/*$naslov=str_replace(",",";.?",$naslov);
			$tekst=str_replace(",",";.?",$tekst);
			$tekst=str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$tekst);
			file_put_contents("../novosti.csv",$naslov.','.$slika.','.$tekst.','.$today."\n",FILE_APPEND);*/
			include 'baza.php';
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into novosti (tekst,datum,idAutor,komentari,linkSlike,naslov) values(?,?,?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($tekst,$today,$idAutor,$komentari,$slika,$naslov));
			Baza::disconnect();
			$uspjeh="Uspjesno ste objavili novost!";
		}
		else{
			$greska="Niste popunili sva polja!";
		}
	}
?>

<form id="formaObjava" onsubmit="return SubmitObjavu()" method="Post">
<span id="greska"><?php echo $greska; ?></span>
<span id="uspjeh"><?php echo $uspjeh; ?></span>
	<div>
		<p>Naslov:</p>
		<input class="inputTextEditorObjaviNovost" type="text" oninput="ValidirajNaslov(this)" value="" name="naslov"/>
		<p>Link slike:</p>
		<input class="inputTextEditorObjaviNovost" type="text" oninput="ValidirajLink(this)" value="" name="linkSlike"/>
		<p>Tekst:</p>
		<textarea id="MultilineEditorObjaviNovost" name="tekstualno" oninput="ValidirajTekst(this)" value="" cols="40" rows="5"></textarea>
		<br/>
		<input type="checkbox" name="komentari" value="Omogući komentare"/>Omogući komentare<br/>
		<!--<p>Kod:</p>
		<input class="inputTextEditorObjaviNovost" oninput="AjaxValidirajKod(this)" type="text" value="" name="kodDrzave" />
		<p>Broj telefona:</p>
		<input class="inputTextEditorObjaviNovost" oninput=" AjaxValidirajBrojTel(this)" type="text" value="" name="brojTel" />-->
	</div>
	<div id="formaObjavaBbtPonisti">
		<input type="button" name="izadji" onclick="IzadjiIzNovosti()" value="Ponisti"/>
	</div>
	<div id="formaObjavaBbtObjavi">				
		<input type="submit" name="objavi" value="Objavi novost"/>
	</div>	
</form>	