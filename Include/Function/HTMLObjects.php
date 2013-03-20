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

function table($datos,$width="")
{
	$text ="<table>";
	if($width!="")
	{
		$cuantos=split(";",$width);
		for($i=0;$i<count($cuantos);$i++)
			$cuantos[$i]=split("-",$cuantos[$i]);
	}
	for($i=0;$i<count($datos);$i++)
	{
		$text .="<tr>";
		for($j=0;$j<count($datos[$i]);$j++)
		{
			if($j==0 && $width!="")
			{
				$hay=0;
				for($k=0;$k<count($cuantos);$k++)
				{
					if($cuantos[$k][0]==$i)
					{
						$text .="<td width=\"".$cuantos[$k][1]."px\">".$datos[$i][$j]."</td>";
						$hay++;
					}
					if($hay==0)
						$text .="<td>".$datos[$i][$j]."</td>";
				}
			}
			else
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

function botonVoto($idBatalla,$idPersonaje,$idPersonajesBatalla,$content)
{
	$text = "";
	$text .="<div id=\"B".$idBatalla."-".$idPersonaje."\" class=\"botoncito\">
<button class=\"button\" onclick=\"change('B".$idBatalla."-".$idPersonaje."','".$idPersonajesBatalla."')\">
".$content."
</button>
</div>";
	return $text;
}

function botonEscoger($content,$instancia,$cantidad)
{
	$text = "";
	$text .="<div class=\"botoncito\">
<button class=\"button\" onclick=\"Instancia('".$instancia."','".$cantidad."')\">
".$content."
</button>
</div>";
	return $text;
}

function formVoto($nameForm,$action,$batallas,$limite)
{
	$text = "";
	$text .="<form name=\"".$nameForm."\" action=\"".$action."\">
<input type=\"hidden\" value=\"";
for($i=0;$i<count($batallas);$i++)
{
	$text .="B".$batallas."-L0/".$limite."-V";
	if($i+1!=count($batallas))
		$text .=";";
}
$text .="\" name=\"votacion\" />
</form>
";
	return $text;
}

function Nominaciones($cant)
{
	$text ="";
	$text .="
<h1>Nominaciones</h1>
<div class=\"fight\">
";
	$datos[0][0]="Nombre";
	$datos[0][1]="Series";
for($i=0;$i<$cant;$i++)
{
	$datos[$i+1][0]=input("Nombre[]","text");
	$datos[$i+1][1]=input("Serie[]","text");
}
$datos[$cant+1][0]="";
$datos[$cant+1][1]=input("submit","submit");
$text1 = table($datos);
$text .= form($text1,"inscipcion","?id=4&action=2&trato=1");
$text .="</div>";
return $text;
}

function img($src,$height="",$width="",$id="",$class="")
{
	$text = "<img src=\"".$src."\" alt=\"\" ";
	if($id!="")
		$text .= " id=\"$id\" ";
	if($class!="")
		$text .= " class=\"$class\" ";
	if($height!="")
		$text .= " height=\"$height\" ";
	if($width!="")
		$text .= " width=\"$width\" ";

	$text .= "/>\n";
	return $text;
	}
?>
