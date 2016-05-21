function UcitajFormu(){
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("vrh").innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404)
			document.getElementById("vrh").innerHTML = "Greska: nepoznat URL";
	}
	ajax.open("GET", "stranice/login.php", true);
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
	ajax.open("GET", "stranice/test.php", true);
	ajax.send();	
}

function SubmitObjavu(){
	var ajax = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append(document.getElementsByName("naslov")[0].name,document.getElementsByName("naslov")[0].value);
	formdata.append(document.getElementsByName("linkSlike")[0].name,document.getElementsByName("linkSlike")[0].value);
	formdata.append(document.getElementsByName("tekstualno")[0].name,document.getElementsByName("tekstualno")[0].value);

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
