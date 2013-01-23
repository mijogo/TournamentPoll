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
		if(!isset($_GET['id']))
			$_GET['id']=1;
		if(!isset($_GET['action']))
			$_GET['action']=1;

		$logicaVista = new LogicV();		
		$logicaCodigo = new LogicC();
		if($_GET['action']==1)
		{
			$logicaCodigo->Schedule();

			echo $this->Cabecera();	
			echo $this->Principal();		
			echo $this->Cuerpo($logicaVista->logicaView());
			echo $this->Pie();
		}
		if($_GET['action']==2)
		{
			$logicaCodigo->trabaja();
		}
	}
	
	function Cabecera()
	{
		if($_GET['id']==10)
		{
			$moreLogicaCodigo = new LogicC();

			$datos1 = $moreLogicaCodigo->datosGrafo(193,20,"01:00:00",1320,8);
			$datos2 = $moreLogicaCodigo->datosGrafo(196,20,"01:00:00",1320,8);
			$datos3 = $moreLogicaCodigo->datosGrafo(199,20,"01:00:00",1320,8);

			return $this->estructura->head(grafico("Mega Grafo","grafV1",$datos1[0],$datos1[1]).grafico("Mega Grafo","grafV2",$datos2[0],$datos2[1]).grafico("Mega Grafo","grafV3",$datos3[0],$datos3[1]));
		}
		else
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