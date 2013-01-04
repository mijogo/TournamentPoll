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
		$logicaVista = new LogicV();		
		$logicaCodigo = new LogicC();
		$logicaCodigo->Schedule();
		echo $this->Cabecera();	
		echo $this->Principal();		
		echo $this->Cuerpo($logicaVista->logicaView());
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