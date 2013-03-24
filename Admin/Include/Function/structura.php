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
  <script type=\"text/javascript\" src=\"js/funciones.js\"></script>
".$script."
</head>
";
		return $text;
	}
	
	function MenuPrincipal()
	{
			$MenuActual = new MenuAdmin();
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
	
	function body($widget="",$content="")
	{
		$text="";
		$text .="<div id=\"Content\">
	<div id=\"Principal\">
 ".$content."
	</div>
	<div id=\"Sec\">";
	for($i=0;$i<count($widget);$i++)
	{
		$text .="<div class=\"burbujas\">".$widget[$i]."
</div>
";
	}

$text .="</div>
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
	
		function login()
	{
		$text = "<font face=\"verdana,arial\" size=-1>
<center><table cellpadding='2' cellspacing='0' border='0' id='ap_table'>
<tr><td bgcolor=\"blue\"><table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td bgcolor=\"blue\" align=center style=\"padding:2;padding-bottom:4\">
<b><font size=-1 color=\"white\" face=\"verdana,arial\"><b>Enter your login and password</b></font></th></tr>
<tr><td bgcolor=\"white\" style=\"padding:5\"><br>
<form method=\"post\" action=\"?id=0&action=2\" name=\"aform\" target=\"_top\">
<input type=\"hidden\" name=\"action\" value=\"login\">
<input type=\"hidden\" name=\"hide\" value=\"\">
<center><table>
<tr><td><font face=\"verdana,arial\" size=-1>Login:</font></td><td><input type=\"text\" name=\"login\"></td></tr>
<tr><td><font face=\"verdana,arial\" size=-1>Password:</font></td><td><input type=\"password\" name=\"password\"></td></tr>
<tr><td><font face=\"verdana,arial\" size=-1>&nbsp;</font></td><td><font face=\"verdana,arial\" size=-1><input type=\"submit\" value=\"Enter\"></font></td></tr>
<tr><td colspan=2><font face=\"verdana,arial\" size=-1>&nbsp;</font></td></tr>
</table></center>
</form>
</td></tr></table></td></tr></table>";
return $text;
	}
	
	function registro()
	{
				$text = "<font face=\"verdana,arial\" size=-1>
<center><table cellpadding='2' cellspacing='0' border='0' id='ap_table'>
<tr><td bgcolor=\"blue\"><table cellpadding='0' cellspacing='0' border='0' width='100%'><tr><td bgcolor=\"blue\" align=center style=\"padding:2;padding-bottom:4\">
<b><font size=-1 color=\"white\" face=\"verdana,arial\"><b>Registro</b></font></th></tr>
<tr><td bgcolor=\"white\" style=\"padding:5\"><br>
<form method=\"post\" action=\"?id=-1&action=2\" name=\"aform\" target=\"_top\">
<input type=\"hidden\" name=\"action\" value=\"login\">
<input type=\"hidden\" name=\"hide\" value=\"\">
<center><table>
<tr><td><font face=\"verdana,arial\" size=-1>Login:</font></td><td><input type=\"text\" name=\"login\"></td></tr>
<tr><td><font face=\"verdana,arial\" size=-1>Password:</font></td><td><input type=\"password\" name=\"password\"></td></tr>
<tr><td><font face=\"verdana,arial\" size=-1>Mail:</font></td><td><input type=\"text\" name=\"mail\"></td></tr>
<tr><td><font face=\"verdana,arial\" size=-1>&nbsp;</font></td><td><font face=\"verdana,arial\" size=-1><input type=\"submit\" value=\"Enter\"></font></td></tr>
<tr><td colspan=2><font face=\"verdana,arial\" size=-1>&nbsp;</font></td></tr>
</table></center>
</form>
</td></tr></table></td></tr></table>";
return $text;
	}

}
?>