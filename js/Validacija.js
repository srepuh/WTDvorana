onload=function(){
	//validacija
		var elem= document.getElementById("tbTel");
		addRedBorder(elem);
		var elem1= document.getElementById("tbEmail");
		addRedBorder(elem1);
		var elem2= document.getElementById("tbIme");
		addRedBorder(elem2);
	//
}


//validacija :D
function ValidirajImeIprezime(tb){
	var reg=/\w{2}\s\w{2}/i;
	if(!reg.test(tb.value))
		addRedBorder(tb);
	else{
		removeRedBorder(tb);
	}
}

function ValidirajTelefon(tb){
	var elem= document.getElementById("tbEmail");
	
	var reg=/^\(?([0-9]{3})\)?[/. ]?([0-9]{3})[-. ]?([0-9]{3})/i;
	var reg2=/^\(?([0-9]{3})\)?[/. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})/i;
	if(!reg.test(tb.value) && !reg2.test(tb.value)){
		addRedBorder(tb);
		addRedBorder(elem);
	}
	else{
		removeRedBorder(tb);
		removeRedBorder(elem);
	}
}

function ValidirajEmail(tb){
	var elem= document.getElementById("tbTel");
	
	var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9])+\.)+([a-z]{3})/i;
	if(!reg.test(tb.value)){
		addRedBorder(tb);
		addRedBorder(elem);
	}
	else{
		removeRedBorder(tb);
		removeRedBorder(elem);
	}
	
}

function ValidirajGodinu(tb){
	var d=new Date();
	if(tb.value<=d.getFullYear() && tb.value>1900)
		removeRedBorder(tb);
	else{
		addRedBorder(tb);
	}
}


function addRedBorder(tb){
	tb.style.border="2px solid red";
}

function removeRedBorder(tb){
	tb.style.border="";
}

//
