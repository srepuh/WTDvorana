function UcitajFormu(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("vrh").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("vrh").innerHTML = "Greska: nepoznat URL";
	}
	var check=window.location.pathname;
	if(check.indexOf("autori.php")==-1)
		ajax.open("GET", "stranice/login.php", true);
	else{
		ajax.open("GET", "login.php", true);
	}
	ajax.send();	
}

function UcitajObjavljivanjeNovostiFormu(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("objavljivanjeNovosti").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("objavljivanjeNovosti").innerHTML = "Greska: nepoznat URL";
	}
	var check=window.location.pathname;
	if(check.indexOf("autori.php")==-1)
		ajax.open("GET", "stranice/test.php", true);
	else
		ajax.open("GET", "test.php", true);
	ajax.send();	
}

function SubmitObjavu(){
	var ajax = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append(document.getElementsByName("naslov")[0].name,document.getElementsByName("naslov")[0].value);
	formdata.append(document.getElementsByName("linkSlike")[0].name,document.getElementsByName("linkSlike")[0].value);
	formdata.append(document.getElementsByName("tekstualno")[0].name,document.getElementsByName("tekstualno")[0].value);
	formdata.append(document.getElementsByName("komentari")[0].name,document.getElementsByName("komentari")[0].value);
	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("objavljivanjeNovosti").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("objavljivanjeNovosti").innerHTML = "Greska: nepoznat URL";
	}
	ajax.open("POST", "stranice/test.php");
	ajax.send(formdata);
	return false;
}

function Login(){
	UcitajFormu();
	var element=document.getElementsByTagName("body");
	element[0].style.marginTop="19px";
	var log=document.getElementById("login");
	log.style.display="block";
}

function Logout(){
	UcitajFormu();
	var element=document.getElementsByTagName("body");
	element[0].style.marginTop="19px";
	var log=document.getElementById("logout");
	log.style.display="block";
}


function OtvoriProzorZaNovost(){
	UcitajObjavljivanjeNovostiFormu();
	var el=document.getElementById("objavljivanjeNovosti");
	el.style.display="block";
		
	//validacija
		var elem= document.getElementsByName("naslov")[0];
		addRedBorder(elem);
		var elem1= document.getElementsByName("linkSlike")[0];
		addRedBorder(elem1);
		var elem2= document.getElementsByName("tekstualno")[0];
		addRedBorder(elem2);
	//
}

function IzadjiIzNovosti(){
	var elNovostCijeli=document.getElementById("objavljivanjeNovosti");
	elNovostCijeli.style.display="none";
}

function OtvoriNovost(id,check){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementsByClassName("container")[0].innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementsByClassName("container")[0].innerHTML = "Greska: nepoznat URL";
		document.getElementById("postaviNovuVisible").style.display="none";
	}
	if(check)
		ajax.open("GET", "stranice/ucitajNovost.php?id="+id, true);
	else
		ajax.open("GET", "ucitajNovost.php?id="+id, true);
	ajax.send();	
}

function OpenAutor(id){
	var theForm, input1;
	theForm = document.createElement('form');
	var check=window.location.pathname;
	if(check.indexOf("autori.php")==-1)
		theForm.action = 'stranice/autori.php';
	else
		theForm.action = 'autori.php';
	theForm.method = 'get';
	input1 = document.createElement('input');
	input1.type = 'hidden';
	input1.name = 'id';
	input1.value = id;
	theForm.appendChild(input1);
	theForm.submit();
}

function DodajKomentar(id){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("formaObjavaKomentaraPocetna").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("formaObjavaKomentaraPocetna").innerHTML = "Greska: nepoznat URL";
		document.getElementById("formaObjavaKomentaraPocetna").style.display="block";
	}
	var check=window.location.pathname;
	ajax.open("GET", "stranice/dodajKomentar.php?id="+id, false);
	ajax.send();	
}

function ZatvoriDodavanjeKomentara(){
	document.getElementById("formaObjavaKomentaraPocetna").style.display="none";
}

function ObjaviKomentar(id){
	var ajax = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append(document.getElementsByName("nick")[0].name,document.getElementsByName("nick")[0].value);
	formdata.append(document.getElementsByName("komentar")[0].name,document.getElementsByName("komentar")[0].value);
	formdata.append(document.getElementsByName("idKomentara")[0].name,document.getElementsByName("idKomentara")[0].value);
	formdata.append("id",id);
	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("formaObjavaKomentaraPocetna").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("formaObjavaKomentaraPocetna").innerHTML = "Greska: nepoznat URL";
		OtvoriNovost(id,true);
	}
	ajax.open("POST", "stranice/dodajKomentar.php?id="+id);
	ajax.send(formdata);
	return false;
	
}

function KomentarNaKomentar(idKomentara, idNovosti){
	DodajKomentar(idNovosti);
	DodajKomentar(idNovosti);
    var eL=	document.getElementsByName("idKomentara")[0];
	eL.value=idKomentara;
}
//validacija dodavanja objava i  AJAX
function ValidirajNaslov(tb){
	var reg=/\w{2}/i;
	if(!reg.test(tb.value))
		addRedBorder(tb);
	else{
		removeRedBorder(tb);
	}
}

function ValidirajLink(tb){
	if(!tb.value.length!=0)
		addRedBorder(tb);
	else{
		removeRedBorder(tb);
	}
}

function ValidirajTekst(tb){
	var reg=/\w{2}/i;
	if(!reg.test(tb.value))
		addRedBorder(tb);
	else{
		removeRedBorder(tb);
	}
}

function AjaxValidirajKod(tb){
	var znak=tb.value;
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		var el= document.getElementsByName("brojTel")[0];
		if (ajax.readyState == 4 && ajax.status == 200){
			var rez=JSON.parse(ajax.response);
			if(rez[0]!=null){
				el.value="+"+rez[0]["callingCodes"];
			}else{
				el.value="";
			}
		}
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementsByName("kodDrzave").innerHTML = "Greska: nepoznat URL";
	}
	ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes="+znak, true);
	ajax.send();	
}

function AjaxValidirajBrojTel(tb){
	var broj=tb.value;
	if(broj.indexOf("+")>-1){
		broj=broj.substr(1,broj.length);
	}
	var el= document.getElementsByName("kodDrzave")[0];
	el.value="";
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200){
			var rez=JSON.parse(ajax.response);
			if(rez[0]!=null){
				el.value= rez[0]["alpha2Code"].toLowerCase();
			}else{
				el.value="";
			}
		}
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementsByName("brojTel").innerHTML = "Greska: nepoznat URL";
	}
	ajax.open("GET", "https://restcountries.eu/rest/v1/callingcode/"+broj, true);
	ajax.send();	
}

function addRedBorder(tb){
	tb.style.border="2px solid red";
}

function removeRedBorder(tb){
	tb.style.border="";
}
//
