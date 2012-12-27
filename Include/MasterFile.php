<?php
require_once "include.php";
class MasterClass
{
	function MasterClass()
	{
		$this->estructura = new structura();
	}
	
	function Trabajar()
	{
		$logica = new LogicV();
		echo $this->Cabecera();	
		echo $this->Principal();		
		echo $this->Cuerpo($logica->logicaView());
		echo $this->Pie();
	}
	
	function Cabecera()
	{
		return $this->estructura->head();
	}
	
	function Principal()
	{
		return $this->estructura->MenuPrincipal();
	}
	
	function Cuerpo($contenido="")
	{
		return $this->estructura->body($contenido);
	}
	
	function Pie()
	{
		return $this->estructura->foot();
	}
}
?>