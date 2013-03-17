<?php
class structura
{
	function structura()
	{}
	
	function head($script="")
	{
		$text = "";
		$text .="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>
<meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />
<meta name=\"description\" content=\"website description\" />
<meta name=\"keywords\" content=\"website keywords, website keywords\" />
<title>Sin título 1</title>
<link href=\"css/style_class.css\" rel=\"stylesheet\" type=\"text/css\" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type=\"text/javascript\" src=\"js/modernizr-1.5.min.js\"></script>
<script type=\"text/javascript\">
<!--
function actualizaReloj(){  
marcacion = new Date()  
Hora = marcacion.getHours()  
Minutos = marcacion.getMinutes()  
Segundos = marcacion.getSeconds()  
Anio = marcacion.getFullYear()
Mes = marcacion.getMonth()
Dia = marcacion.getDay()
if (Hora<=9) 
Hora = \"0\" + Hora
if (Minutos<=9) 
Minutos = \"0\" + Minutos
if (Segundos<=9) 
Segundos = \"0\" + Segundos
if (Mes <=9) 
Mes = \"0\" + Mes 
if (Dia <=9) 
Dia = \"0\" + Dia
DiaA = \"<div class='masGrandesL'>\"+Dia+\"/\"+Mes+\"/\"+Anio+\"<div/>\"
HoraA = \"<div class='grandes'>\"+Hora+\":\"+Minutos+\":\"+Segundos+\"<div/>\"
Total = DiaA+HoraA 
document.getElementById('Fecha_Reloj').innerHTML = Total 
setTimeout(\"actualizaReloj()\",1000)  
} 


function change(a,miembros)
{
	var leer = document.habda.asda.value;
	var batallas = leer .split(\";\")
	for (var i=0;i<batallas.length;i++)
	{
		var secuencias = batallas[i].split(\"-\")
		var bataId = secuencias[0].substr(1)
		var miem = a.split(\"-\")
		var batallaId = miem[0].substr(1)
		if(bataId == batallaId)
		{
			var limites = secuencias[1].substr(1)
			var dif =  limites.split(\"/\")
			dif[0]++
			if(dif[0]==dif[1])
			{
				var todos = miembros.split(\"-\")
				for(var j=0;j<todos.length;j++)
				{
					var esta = false
					for(var k=2;k<secuencias.length;k++)
					{
						if(k==2)
						{
							var veamos = secuencias[k].substr(1)
							if(veamos != \"\")
							{
								if(veamos == todos[j])
								{
									esta = true
								}
							}
						}
						else
						{
							if(secuencias[k] == todos[j])
							{
								esta = true
							}
						}
					}
					if(miem[1]==todos[j])
					{
						esta = true
					}
					if(!esta)
					{
						content = document.getElementById(miem[0]+\"-\"+todos[j]).innerHTML
						content.split(\">\")
						content[1].split(\"<\")
						document.getElementById(miem[0]+\"-\"+todos[j]).innerHTML=\"<button class='buttonDes'>\"+content[1][0]+\"</button>\"
					}
				}
			}
			var com = secuencias[0]+\"-L\"+dif[0]+\"/\"+dif[1]+\"-V\"+miem[1]
			for(var k=2;k<secuencias.length;k++)
			{
				if(k==2)
				{
					var veamos = secuencias[k].substr(1)
					if(veamos != \"\")
					{
						com += \"-\"+veamos
					}
				}
				else
				{
					com += \"-\"+secuencias[k]
				}
			}
			var usar=\"\"
			for (var r=0;r<batallas.length;r++)
			{
				if(r==i)
				{
					usar += com
				}
				else
				{
					usar += batallas[r]
				}
				if(r!=batallas.length-1)
				{
					usar += \";\"
				}
			}
			document.habda.asda.value = usar
		}
	}
	content = document.getElementById(a).innerHTML
	content.split(\">\")
	content[1].split(\"<\")
	document.getElementById(a).innerHTML=\"<button class='buttonAct' onclick=\"changeR('\"+a+\"','\"+miembros+\"')\">\"+content[1][0]+\"</button>\"
}

function changeR(a,miembros)
{
	var leer = document.habda.asda.value;
	var batallas = leer .split(\";\")
	for (var i=0;i<batallas.length;i++)
	{
		var secuencias = batallas[i].split(\"-\")
		var bataId = secuencias[0].substr(1)
		var miem = a.split(\"-\")
		var batallaId = miem[0].substr(1)
		if(bataId == batallaId)
		{
			var limites = secuencias[1].substr(1)
			var dif = limites.split(\"/\")
			dif[0]--
			if(dif[0]+1==dif[1])
			{
				var todos = miembros.split(\"-\")
				for(var j=0;j<todos.length;j++)
				{
					var esta = false
					for(var k=2;k<secuencias.length;k++)
					{
						if(k==2)
						{
							var veamos = secuencias[k].substr(1)
							if(veamos != \"\")
							{
								if(veamos == todos[j])
								{
									esta = true
								}
							}
						}
						else
						{
							if(secuencias[k] == todos[j])
							{
								esta = true
							}
						}
					}
					if(miem[1]==todos[j])
					{
						esta = true
					}
					if(!esta)
					{
						content = document.getElementById(miem[0]+\"-\"+todos[j]).innerHTML
						content.split(\">\")
						content[1].split(\"<\")
						document.getElementById(miem[0]+\"-\"+todos[j]).innerHTML=\"<button class='button' onclick=\"change('\"+miem[0]+\"-\"+todos[j]+\"','\"+miembros+\"')\">\"+content[1][0]+\"</button>\"
					}
				}
			}
			var com = secuencias[0]+\"-L\"+dif[0]+\"/\"+dif[1]+\"-V\"
			nh=0;
			for(var k=2;k<secuencias.length;k++)
			{
				if(k==2)
				{
					var veamos = secuencias[k].substr(1)
					if(veamos != \"\")
					{
						if(miem[1]!=veamos)
						{
							com += veamos
							nh++
						}
					}
				}
				else
				{
					if(miem[1]!=secuencias[k])
					{
						if(nh!=0)
							com += \"-\"+secuencias[k]
						else
						{
							com += secuencias[k]
							nh++
						}	
					}
				}
			}
			var usar=\"\"
			for (var r=0;r<batallas.length;r++)
			{
				if(r==i)
				{
					usar += com
				}
				else
				{
					usar += batallas[r]
				}
				if(r!=batallas.length-1)
				{
					usar += \";\"
				}
			}
			document.habda.asda.value = usar
		}
	}
	content = document.getElementById(a).innerHTML
	content.split(\">\")
	content[1].split(\"<\")
	document.getElementById(a).innerHTML=\"<button class='button' onclick=\"change('\"+a+\"','\"+miembros+\"')\">\"+content[1][0]+\"</button>\"
}


-->
</script>
".$script."
</head>
";
		return $text;
	}
	
	function MenuPrincipal()
	{
			$MenuActual = new Menu();
			$MenuActual = $MenuActual->read();
			$text = "";
			$text .= "<body onload=\"actualizaReloj()\">
<div id=\"page\">
<div id=\"Header\">
<div id=\"Banner\">
	<a href=\"pruebas.html\">
	<img height=\"200\" src=\"images/Banner.png\" width=\"900\" /></a></div>
<div id=\"Menu\">
 <nav>
        <ul class=\"sf-menu\" id=\"nav\">
          \n";
        
        for($i=0;$i<count($MenuActual);$i++)
        {
        	if($MenuActual[$i]->getIdDependencia()==-1)
        	{
        		if($_GET['id']==$MenuActual[$i]->getId())
        			$text .= "<li class=\"selected\"><a href=\"?id=".$MenuActual[$i]->getId()."\">".$MenuActual[$i]->getTitulo()."</a>";
        		else
        			$text .= "<li><a href=\"?id=".$MenuActual[$i]->getId()."\">".$MenuActual[$i]->getTitulo()."</a>";
        		$dub = false;
        		for($j=0;$j<count($MenuActual);$j++)
        		{
        			if($MenuActual[$j]->getIdDependencia()==$MenuActual[$i]->getId())
        			{
        				if(!$dub)
        				{
        					$dub = true;
        					$text .= "<ul>\n";
        				}
        				if($_GET['id']==$MenuActual[$j]->getId())
        					$text .= "<li class=\"selected\"><a href=\"?id=".$MenuActual[$j]->getId()."\">".$MenuActual[$j]->getTitulo()."</a>";
        				else
        					$text .= "<li><a href=\"?id=".$MenuActual[$j]->getId()."\">".$MenuActual[$j]->getTitulo()."</a>";
        				
        				$sub = false;
        				for($k=0;$k<count($MenuActual);$k++)
        				{
        					if($MenuActual[$k]->getIdDependencia()==$MenuActual[$j]->getId())
        					{
        						if(!$sub )
        						{
        							$sub = true;
        							$text .= "<ul>\n";
        						}
        						if($_GET['id']==$MenuActual[$k]->getId())
        							$text .= "<li class=\"selected\"><a href=\"?id=".$MenuActual[$k]->getId()."\">".$MenuActual[$k]->getTitulo()."</a></li>\n";
        						else
        							$text .= "<li><a href=\"?id=".$MenuActual[$k]->getId()."\">".$MenuActual[$k]->getTitulo()."</a></li>\n";
        					}
     		 			 }
     		 			 if($sub)
        					$text .= "</ul>\n";
        				$text .="</li>\n";

        			}
     		   }
     		   if($dub)
        			$text .= "</ul>\n";
        		$text .="</li>\n";

        	}
        }
       $text .= " </ul>\n
      </nav>
</div>
</div>
";
					return $text;
	}
	
	function body($content="")
	{
		$text="";
		$text .="<div id=\"Content\">
	<div id=\"Principal\">
 ".$content."
	</div>
	<div id=\"Sec\">
<div class=\"burbujas\">
<h5>Last Match Result</h5>
<div class=\"fight\">
<table>
	<tr>
	<td width=\"200px\">Tamako Kitashirakawa</td>
	<td>43</td>
	</tr>
	<tr>
	<td>Anko Kitashirakawa</td>
	<td>72</td>
	</tr>
</table>
</div>
</div>
<div class=\"burbujas\">
<h5>Next Match</h5>
<div class=\"fight\">Miss Anime Tournament 2013<br/>
Nominations<br/>
<br/>
april 15th 2013
</div>
</div>
<div class=\"burbujas\">
<h5>Current Time (GMT)</h5>
<div class=\"fight\"><table><tr><td id=\"Fecha_Reloj\"></td></tr></table></div>
</div>
</div>
<div class=\"empuja\">&nbsp;</div>
</div>
";
		return $text;
	}
	
	function foot()
	{
		$text = "";
		$text ="<div id=\"Foot\">
Aca iria los agradecimiento y las redes sociales<br/>
tambien se le podrian agregar otras cosas</div>
</div>
  <!-- javascript at the bottom for fast page loading -->
  <script type=\"text/javascript\" src=\"js/jquery.js\"></script>
  <script type=\"text/javascript\" src=\"js/jquery.easing-sooper.js\"></script>
  <script type=\"text/javascript\" src=\"js/jquery.sooperfish.js\"></script>
  <script type=\"text/javascript\" src=\"js/image_fade.js\"></script>
  <script type=\"text/javascript\">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>

</html>
";
		return $text;
	}
}
?>