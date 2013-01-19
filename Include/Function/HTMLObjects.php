<?php
function refresh($time)
{
	return "<meta http-equiv=\"refresh\" content=\"".$time."\">";
}

function div($content ="",$id="",$class="",$style="")
{
	$text = "<div";
	if($id!="")
		$text .= " id=\"$id\" ";
	if($class!="")
		$text .= " class=\"$class\" ";
	if($style!="")
		$text .= " style=\"$style\" ";
	$text .= ">\n";
	$text .= $content;
	$text .= "\n</div>";
	return $text;
}

function form($content="",$name="",$action="",$method="POST")
{
	$text = "<form name=\"".$name."\" action=\"".$action."\" method=\"".$method."\">
	".$content."
	</form>";
	return $text;
}

function table($datos)
{
	$text ="<table>";
	for($i=0;$i<count($datos);$i++)
	{
		$text .="<tr>";
		for($j=0;$j<count($datos[$i]);$j++)
		{
			$text .="<td>".$datos[$i][$j]."</td>";
		}
		$text .="</tr>";
	}
	$text .="</table>";
	return $text;
}
function input($nombre,$tipo,$value="")
{
	$text = "<input type=\"".$tipo."\" name=\"".$nombre."\"";
	if($value != "")
		$text .= " value=\"".$value."\"";
	$text .=">";
	return $text;
}

function selected($name ="",$values="")
{
	$text = "";
	$text .="<SELECT NAME=\"".$name."\">";
	for($i=0;$i<count($values);$i++)
	{
		$text .="<OPTION VALUE=\"".$values[$i][0]."\">".$values[$i][1];
	}
	$text .="</SELECT>";
	return $text;
}
?>
