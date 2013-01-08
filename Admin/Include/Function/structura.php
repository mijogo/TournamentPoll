<?php
class structura
{
	function structura()
	{}
	
	function head()
	{
		$text = "";
		$text .="<!DOCTYPE HTML><html>\n
\n
<head>\n
  <title>Tournament Poll</title>\n
  <meta name=\"description\" content=\"website description\" />\n
  <meta name=\"keywords\" content=\"website keywords, website keywords\" />\n
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />\n
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\" />\n
  <!-- modernizr enables HTML5 elements and feature detects -->\n
  <script type=\"text/javascript\" src=\"js/modernizr-1.5.min.js\"></script>\n
</head>\n
";
		
		return $text;
	}
	
	function MenuPrincipal()
	{
			$MenuActual = new MenuAdmin();
			$MenuActual = $MenuActual->read();
			$text = "";
			$text .= "
			<body>\n
  <div id=\"main\">\n
    <header>\n
      <div id=\"logo\">\n
        <div id=\"logo_text\">\n
          <!-- class=\"logo_colour\", allows you to change the colour of the text -->\n
          <h1><a href=\"index.html\">Tournament <span class=\"logo_colour\"> Poll</span></a></h1>\n
          <h2>Template Basic</h2>\n
        </div>\n
      </div>\n
      <nav>\n
        <ul class=\"sf-menu\" id=\"nav\">\n";
        
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
        /*
          <li class=\"selected\"><a href=\"index.html\">Home</a></li>\n
          <li><a href=\"about.html\">About Me</a></li>\n
          <li><a href=\"portfolio.html\">My Portfolio</a></li>\n
          <li><a href=\"blog.html\">Blog</a></li>\n
          <li><a href=\"#\">Example Drop Down</a>\n
            <ul>\n
              <li><a href=\"#\">Drop Down One</a></li>\n
              <li><a href=\"#\">Drop Down Two</a>\n
                <ul>\n
                  <li><a href=\"#\">Sub Drop Down One</a></li>\n
                  <li><a href=\"#\">Sub Drop Down Two</a></li>\n
                  <li><a href=\"#\">Sub Drop Down Three</a></li>\n
                  <li><a href=\"#\">Sub Drop Down Four</a></li>\n
                  <li><a href=\"#\">Sub Drop Down Five</a></li>\n
                </ul>\n
              </li>\n
              <li><a href=\"#\">Drop Down Three</a></li>\n
              <li><a href=\"#\">Drop Down Four</a></li>\n
              <li><a href=\"#\">Drop Down Five</a></li>\n
            </ul>\n
          </li>\n
          <li><a href=\"contact.php\">Contact Us</a></li>\n
          */
       $text .= " </ul>\n
      </nav>\n
    </header>\n

			";
			return $text;
	}
	
	function body($content="")
	{
		$text="";
		$text .="    <div id=\"site_content\">\n
      <div id=\"sidebar_container\">\n
      </div>\n
      <div id=\"content\">\n
       ".$content."
      </div>\n
    </div>\n
";
		return $text;
	}
	
	function foot()
	{
		$text = "";
		$text ="
		<footer>\n
      <p>Copyright &copy; photo_style_two | <a href=\"http://www.css3templates.co.uk\">design from css3templates.co.uk</a></p>\n
    </footer>\n
  </div>\n
  <p>&nbsp;</p>\n
  <!-- javascript at the bottom for fast page loading -->\n
  <script type=\"text/javascript\" src=\"js/jquery.js\"></script>\n
  <script type=\"text/javascript\" src=\"js/jquery.easing-sooper.js\"></script>\n
  <script type=\"text/javascript\" src=\"js/jquery.sooperfish.js\"></script>\n
  <script type=\"text/javascript\" src=\"js/image_fade.js\"></script>\n
  <script type=\"text/javascript\">\n
    $(document).ready(function() {\n
      $('ul.sf-menu').sooperfish();\n
    });\n
  </script>\n
</body>\n
</html>\n

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