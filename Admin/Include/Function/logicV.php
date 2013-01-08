<?php
class LogicV
{
	function LogicV()
	{
	}
	
	function logicaView()
	{
		$text = "";
		
		if($_GET['id']==4)
		{
			$text="";
			$datos[0][0]="Nombre";
			$datos[0][1]=input("Nombre","text");
			
			$datos[1][0]="Serie";
			$datos[1][1]=input("Serie","text");

			$datos[2][0]="";
			$datos[2][1]=input("submit","submit");
			$text1 = table($datos);
			$text .= form($text1,"inscipcion","?id=4&action=2");
		}		
		return $text;
	}
}
?>