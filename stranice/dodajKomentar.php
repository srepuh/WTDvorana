<?php
	$greska="";
	$uspjeh="";
	if( $_SERVER["REQUEST_METHOD"] == "POST" ){
		$nick=htmlspecialchars($_REQUEST['nick']);
		$komentar=htmlspecialchars($_POST['komentar']);
		$id=$_REQUEST['id'];
		if(isset($_REQUEST['idKomentara']))
			$komentarNaKomentar=htmlspecialchars($_REQUEST['idKomentara']);
		else $komentarNaKomentar=NULL;
		$today =date("Y-m-d H:i:s"); 
		print_r($_POST['nick']);
		print_r($_POST['komentar']);
		print_r($_POST['id']);
		if(!empty($_POST['nick']) && !empty($_POST['komentar']) && !empty($_POST['id'])){
			include 'baza.php';
			$baza=Baza::connect();
			$baza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query='Insert into komentari (tekst,datum,idNovosti,nadimakAutora,komentarNaKomentar) values(?,?,?,?,?)';
			$q = $baza->prepare($query);
			$q->execute(array($komentar,$today,$id,$nick,$komentarNaKomentar));
			Baza::disconnect();
			$uspjeh="Uspjesno ste objavili komentar!";
		}
		else{
			$greska="Niste popunili sva polja!";
		}
	}

echo '<form id="formaObjavaKomentara" onsubmit="return ObjaviKomentar('.$_GET['id'].')" method="Post">';
?>
	<span id="greska"><?php echo $greska; ?></span>
	<span id="uspjeh"><?php echo $uspjeh; ?></span>

	<p>Vaš nadimak:</p>
	<input type="text" value="" name="nick" />
	<p>Komentar:</p>
	<textarea id="komentar" name="komentar" value="" cols="40" rows="5" maxlength="100"></textarea>
	<input type="hidden" name="idKomentara" value="" />
	<div id="btnPonistiObjavuKomentara"><input type="button" value="Poništi" name="ponisti" onclick="ZatvoriDodavanjeKomentara()" /></div>
	<div id="btnObjaviKomentar"><input type="submit" value="Objavi" name="objavi" /></div>
</form>
