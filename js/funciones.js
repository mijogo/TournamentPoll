﻿function actualizaReloj(){  
	marcacion = new Date() 
	Hora = marcacion.getUTCHours()  
	Minutos = marcacion.getUTCMinutes()  
	Segundos = marcacion.getUTCSeconds()  
	Anio = marcacion.getUTCFullYear()
	Mes = marcacion.getUTCMonth()
	Dia = marcacion.getUTCDay()
	if (Hora<=9) 
		Hora = "0" + Hora
	if (Minutos<=9) 
		Minutos = "0" + Minutos
	if (Segundos<=9) 
		Segundos = "0" + Segundos
	if (Mes <=9) 
		Mes = "0" + Mes 
	if (Dia <=9) 
		Dia = "0" + Dia
	DiaA = "<div class='masGrandesL'>"+Dia+"/"+Mes+"/"+Anio+"<div/>"
	HoraA = "<div class='grandes'>"+Hora+":"+Minutos+":"+Segundos+"<div/>"
	Total = DiaA+HoraA 
	document.getElementById('Fecha_Reloj').innerHTML = Total 
	setTimeout("actualizaReloj()",1000)  
} 

function change(a,miembros)
{
	var leer = document.habda.asda.value;
	var batallas = leer .split(";")
	for (var i=0;i<batallas.length;i++)
	{
		var secuencias = batallas[i].split("-")
		var bataId = secuencias[0].substr(1)
		var miem = a.split("-")
		var batallaId = miem[0].substr(1)
		if(bataId == batallaId)
		{
			var limites = secuencias[1].substr(1)
			var dif =  limites.split("/")
			dif[0]++
			if(dif[0]==dif[1])
			{
				var todos = miembros.split("-")
				for(var j=0;j<todos.length;j++)
				{
					var esta = false
					for(var k=2;k<secuencias.length;k++)
						if(k==2)
						{
							var veamos = secuencias[k].substr(1)
							if(veamos != "")
								if(veamos == todos[j])
									esta = true
						}
						else
							if(secuencias[k] == todos[j])
								esta = true
					if(miem[1]==todos[j])
						esta = true
					if(!esta)
					{
						var content = document.getElementById(miem[0]+"-"+todos[j]).innerHTML
						content = content.split(">")
						content = content[1].split("<")
						document.getElementById(miem[0]+"-"+todos[j]).innerHTML="<button class='buttonDes'>"+content[0]+"</button>"
					}
				}
			}
			var com = secuencias[0]+"-L"+dif[0]+"/"+dif[1]+"-V"+miem[1]
			for(var k=2;k<secuencias.length;k++)
				if(k==2)
				{
					var veamos = secuencias[k].substr(1)
					if(veamos != "")
						com += "-"+veamos
				}
				else
					com += "-"+secuencias[k]
			var usar=""
			for (var r=0;r<batallas.length;r++)
			{
				if(r==i)
					usar += com
				else
					usar += batallas[r]
				if(r!=batallas.length-1)
					usar += ";"
			}
			document.Votar.votacion.value = usar
		}
	}
	var content = document.getElementById(a).innerHTML
	content = content.split(">")
	content = content[1].split("<")
	document.getElementById(a).innerHTML="<button class='buttonAct' onclick=\"changeR('"+a+"','"+miembros+"')\">"+content[0]+"</button>"
}

function changeR(a,miembros)
{
	var leer = document.habda.asda.value;
	var batallas = leer .split(";")
	for (var i=0;i<batallas.length;i++)
	{
		var secuencias = batallas[i].split("-")
		var bataId = secuencias[0].substr(1)
		var miem = a.split("-")
		var batallaId = miem[0].substr(1)
		if(bataId == batallaId)
		{
			var limites = secuencias[1].substr(1)
			var dif = limites.split("/")
			dif[0]--
			if(dif[0]+1==dif[1])
			{
				var todos = miembros.split("-")
				for(var j=0;j<todos.length;j++)
				{
					var esta = false
					for(var k=2;k<secuencias.length;k++)
						if(k==2)
						{
							var veamos = secuencias[k].substr(1)
							if(veamos != "")
								if(veamos == todos[j])
									esta = true
						}
						else
							if(secuencias[k] == todos[j])
								esta = true
					if(miem[1]==todos[j])
						esta = true
					if(!esta)
					{
						var content = document.getElementById(miem[0]+"-"+todos[j]).innerHTML
						content = content.split(">")
						content = content[1].split("<")
						document.getElementById(miem[0]+"-"+todos[j]).innerHTML="<button class='button' onclick=\"change('"+miem[0]+"-"+todos[j]+"','"+miembros+"')\">"+content[0]+"</button>"
					}
				}
			}
			var com = secuencias[0]+"-L"+dif[0]+"/"+dif[1]+"-V"
			nh=0;
			for(var k=2;k<secuencias.length;k++)
				if(k==2)
				{
					var veamos = secuencias[k].substr(1)
					if(veamos != "")
						if(miem[1]!=veamos)
						{
							com += veamos
							nh++
						}
				}
				else
					if(miem[1]!=secuencias[k])
						if(nh!=0)
							com += "-"+secuencias[k]
						else
						{
							com += secuencias[k]
							nh++
						}
			var usar=""
			for (var r=0;r<batallas.length;r++)
			{
				if(r==i)
					usar += com
				else
					usar += batallas[r]
				if(r!=batallas.length-1)
					usar += ";"
			}
			document.Votar.votacion.value = usar
		}
	}
	var content = document.getElementById(a).innerHTML
	content = content.split(">")
	content = content[1].split("<")
	document.getElementById(a).innerHTML="<button class='button' onclick=\"change('"+a+"','"+miembros+"')\">"+content[0]+"</button>"
}

function Instancia(instancia,cantidad)
{
	if(instancia=="Ronda-1"||instancia=="Ronda-2"||instancia=="Ronda-3"||instancia=="Ronda-4"||instancia=="Ronda-5")
	{
		var text = ""
		text+="<div class=\"botoncito\"><button class=\"buttonAct\" onclick=\"regresar()\">"+instancia+"</button></div>"
		for(var i=1;i<=cantidad;i++)
		{
			var QU ="";
			if(i==1)
				QU = "A";
			if(i==2)
				QU = "B";
			if(i==3)
				QU = "C";
			if(i==4)
				QU = "D";
			if(i==5)
				QU = "E";
			if(i==6)
				QU = "F";
			if(i==7)
				QU = "G";
			if(i==8)
				QU = "H";
			text += "<div class=\"botoncito\"><button class=\"button\" onclick=\"ingresar('"+instancia+"','"+QU+"')\">"+QU+"</button></div>";	
		}
	}
	else
	{
		var text="";
		text += "<div class=\"botoncito\"><button class=\"buttonAct\" onclick=\"regresar()\">"+instancia+"</button></div>";
		for(var i=1;i<=cantidad;i++)
		{
			text += "<div class=\"botoncito\"><button class=\"button\" onclick=\"ingresar('"+instancia+"','"+i+"')\">"+i+"</button></div>";	
		}
	}
	document.getElementById("cambiar").innerHTML = text;
}

function regresar()
{
	location.href='?id=9';
}

function ingresar(instancia,grupo)
{
	location.href="?id=9&trato=2&instancia="+instancia+"&grupo="+grupo;
}