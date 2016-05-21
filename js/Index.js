onload = function Datum(){
	var klasa = "vrijemeObjave";
	var elementi = document.getElementsByClassName(klasa);
	for(var i=0; i<elementi.length; i++){
		var s = elementi[i].getAttribute("datetime");
		var date = new Date(s);
		var ispisi=ispisiPrije(date);
		if(ispisi==""){
			document.getElementsByClassName(klasa)[i].innerHTML=date;
		}else{
			document.getElementsByClassName(klasa)[i].innerHTML = ispisi;
		}
	}
	//filter
	listaLijevih=[].slice.call(document.getElementsByClassName("novostiLijevo"));
	listaDesnih=[].slice.call(document.getElementsByClassName("novostiDesno"));
	filter=document.getElementById("filterDiv");

	tmp.push(filter);
	sve=tmp.concat(SpojiLijevoDesno(listaLijevih,listaDesnih));
	//ucitavanje forme za novosti i objavljivanje
	UcitajFormu();
	UcitajObjavljivanjeNovostiFormu();
}

//filter
var listaLijevih;
var listaDesnih;
var filter;
	
var tmp=[];
var sve;
//


function ispisiPrije(datum){
	var trenutnoVrijeme = new Date();
	var date = trenutnoVrijeme.getDate();
	var year = trenutnoVrijeme.getFullYear();
	var month = trenutnoVrijeme.getMonth()+1; 
	var hour = trenutnoVrijeme.getHours();
	var min = trenutnoVrijeme.getMinutes();
	var sec = trenutnoVrijeme.getSeconds();
	
	var tmp="";
	if(year-datum.getFullYear()==0){		
		if(month-datum.getMonth()<=2){
			if(month-datum.getMonth()==2){
				var tmpDana=31-datum.getDate()+date;
				if(tmpDana<7){
					if(tmpDana==1) tmp=Formatiraj(tmpDana,"dan")
					else{
						tmp =Formatiraj(tmpDana,"dana");			
					}
					if(date-datum.getDate()==0){
						var tmpSati=hour-datum.getHours();
						if(tmpSati==1 || tmpSati==21 ){
							tmp=Formatiraj(tmpSati,"sat");
						}else if((tmpSati>1 && tmpSati<5) || (tmpSati>21 && tmpSati<=24)){
							tmp=Formatiraj(tmpSati,"sata")
						}else{
							tmp =Formatiraj(tmpSati,"sati");			
						}
						if(hour-datum.getHours()<=1){
							if(hour-datum.getHours()==1){
								if(min<datum.getMinutes()){
									var tmpMinute=min+(59-datum.getMinutes());
									var minute=["minutu", "minute", "minuta"];
									tmp =Formatiraj(tmpMinute,minute[GetMinuteLevel(tmpMinute)]);
								}
								else {
									tmp=Formatiraj(1,"sat");
								}
							}else{
								var tmpMinute=min-datum.getMinutes();
								var minute=["minutu", "minute", "minuta"];
								tmp =Formatiraj(tmpMinute,minute[GetMinuteLevel(tmpMinute)]);
								if(min-datum.getMinutes()==0){
									tmp=Formatiraj("par sekundi","");
								}
							}	
						}
					}
				}else if(tmpDana==7) {
					tmp=Formatiraj("1","sedmice");
				}else if(tmpDana<=14){
					tmp=Formatiraj("2","sedmice");
				}else if(tmpDana<=21){
					tmp=Formatiraj("3","sedmice");
				}else if(tmpDana<=30){
					tmp=Formatiraj("4","sedmice");
				}else{
					tmp=DajCijeliDatum(datum);
				}
			}else{
				var tmpDana=date-datum.getDate();
				if(tmpDana<7){
					if(date-datum.getDate()==1) tmp=Formatiraj(date-datum.getDate(),"dan")
					else{
						tmp =Formatiraj(date-datum.getDate(),"dana");			
					}
					if(date-datum.getDate()==0){
						var tmpSati=hour-datum.getHours();
						if(tmpSati==1 || tmpSati==21 ){
							tmp=Formatiraj(tmpSati,"sat");
						}else if((tmpSati>1 && tmpSati<5) || (tmpSati>21 && tmpSati<=24)){
							tmp=Formatiraj(tmpSati,"sata")
						}else{
							tmp =Formatiraj(tmpSati,"sati");			
						}
						if(hour-datum.getHours()<=1){
							if(hour-datum.getHours()==1){
								if(min<datum.getMinutes()){
									var tmpMinute=min+(59-datum.getMinutes());
									var minute=["minutu", "minute", "minuta"];
									tmp =Formatiraj(tmpMinute,minute[GetMinuteLevel(tmpMinute)]);
								}
								else {
									tmp=Formatiraj(1,"sat");
								}
							}else{
								var tmpMinute=min-datum.getMinutes();
								var minute=["minutu", "minute", "minuta"];
								tmp =Formatiraj(tmpMinute,minute[GetMinuteLevel(tmpMinute)]);
								if(min-datum.getMinutes()==0){
									tmp=Formatiraj("par sekundi","");
								}
							}	
						}
					}
					
				}else if(tmpDana==7) {
					tmp=Formatiraj("1","sedmice");
				}else if(tmpDana<=14){
					tmp=Formatiraj("2","sedmice");
				}else if(tmpDana<=21){
					tmp=Formatiraj("3","sedmice");
				}else if(tmpDana<=30){
					tmp=Formatiraj("4","sedmice");
				} 
			}
		}else{
			tmp=DajCijeliDatum(datum);
		}
	}else{
		tmp=DajCijeliDatum(datum);
	}	
	return tmp;
}

function DajCijeliDatum(datum){
	var dan=datum.getDate();
	var mjesec=datum.getMonth()+1;
	var sat=datum.getHours();
	var minuta=datum.getMinutes();
	var sekunde=datum.getSeconds();
	if(dan<10) dan="0"+dan;
	if(mjesec<10) mjesec="0"+mjesec;
	if(sat<10) sat="0"+sat;
	if(minuta<10) minuta="0"+minuta;
	if(sekunde<10) sekunde="0"+sekunde;
	return dan+"-"+mjesec+"-"+datum.getFullYear()+" "+sat+":"+minuta+":"+sekunde;	
}

function GetMinuteLevel(min){
	if(min==1 || min== 21 || min ==31 || min== 41 || min ==51) return 0;
	else if((min>=2 && min<=4) || (min>=22 && min<=24) || (min>=32 && min<=34) || (min>=42 && min<=44) || (min>=52 && min<=54)) return 1;
	else return 2;
}

function Formatiraj(vrijeme,rijec){

	return "prije "+vrijeme+" "+rijec; 
}	


function Filtriraj(){	
	var izabrano=document.getElementById("filter").value;
	var tmpDesni=listaDesnih;
	var tmpLijevi=listaLijevih;
	
	var kontejner=document.getElementsByClassName("container");
	
	filter=document.getElementById("filterDiv");
	var tmpTmp=[];
	tmpTmp.push(filter);
	
	var desniZadovoljavajuci=VratiZadovoljavajuce(tmpDesni,izabrano);
	var lijeviZadovoljavajuci=VratiZadovoljavajuce(tmpLijevi,izabrano);
			
	var sviZadovoljavajuci=tmpTmp.concat(BalansirajISpoji(lijeviZadovoljavajuci,desniZadovoljavajuci));
	if(izabrano==0){
		Ocisti(kontejner);
		PrikaziZadovoljavajuce(sve,kontejner);
	}else{
		Ocisti(kontejner);
		PrikaziZadovoljavajuce(sviZadovoljavajuci,kontejner);
	}
	
}

function BalansirajISpoji(listaL,listaD){
	var lista1;
	var lista2;
	if(listaD.length<listaL.length){
		lista1=listaL;
		lista2=listaD;
	}else{
		lista1=listaD;
		lista2=listaL;
	}
	while(lista1>lista2){
		var razlika=lista1.length-lista2.length;
		var temp=lista1[razlika];
		
		temp.style.marginLeft="20px";
		temp.style.float="left";
		lista2.push(temp);
	}
	var lista=SpojiLijevoDesno(listaL,listaD);
	return lista;
}

function SpojiLijevoDesno(listaL, listaD){
	var lista=[];
	for(i=0; i<listaL.length+listaD.length; i++){
		if(listaL[i]!=null) lista.push(listaL[i]);
		if(listaD[i]!=null) lista.push(listaD[i]);
		if(listaL[i]==null && listaD[i]==null) return lista;
	}
	return lista;
}

function PrikaziZadovoljavajuce(zad,kon){
	for(i=0; i<zad.length; i++){
		kon[0].appendChild(zad[i]);
	}
}

function Ocisti(kon){
	while(kon[0].hasChildNodes()){
		kon[0].removeChild(kon[0].firstChild);
	}
}

function VratiZadovoljavajuce(lista,izabrano){
	var zadovoljavajuci=[];
	for(i=0; i<lista.length; i++){
		var test=lista[i].childNodes[3].innerText;
		var pr=Provjera(test);
		if(pr=="dan" && izabrano==1){
			zadovoljavajuci.push(lista[i]);
		}
		if(pr=="sedmica" && izabrano==2){
			var d=new Date();
			var ble=lista[i].getElementsByClassName("vrijemeObjave");
			var eh=ble[0].getAttribute("datetime");
			var datum= new Date(eh);
			var tit=datum.getDay();
			if(d.getDay()>tit)
				zadovoljavajuci.push(lista[i]);
		}
		if(pr=="mjesec" && izabrano==3){
			zadovoljavajuci.push(lista[i]);
		}
		if(izabrano==0){
			zadovoljavajuci.push(lista[i]);
		}
	}
	return zadovoljavajuci;
}

function Provjera(str){
	if(str.includes("sat") || str.includes("minut") || str.includes("sekund")) return "dan";
	else if(str.includes("1 sedmice") || str.includes("dan")) return "sedmica";
	else if(str.includes("2 sedmice") || str.includes("3 sedmice") || str.includes("4 sedmice")) return "mjesec";
	else return "sve";
}
//


