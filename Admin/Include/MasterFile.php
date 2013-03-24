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
		if(!isset($_GET['action']))
			$_GET['action']=1;

		if(!isset($_COOKIE['user'])||$_COOKIE['user']=="Cerrado")
		{
			if(!isset($_GET['id']))
				$_GET['id']=0;

			if($_GET['id']==-1&&$_GET['action']==1)
				echo $this->estructura->registro();			
			else if($_GET['id']==-1&&$_GET['action']==2)
			{
				$logicaCodigo = new LogicC();
				$logicaCodigo->trabaja();
			}
			else if($_GET['id']==0&&$_GET['action']==2)
			{
				$logicaCodigo = new LogicC();
				$logicaCodigo->trabaja();
			}
			else
				echo $this->estructura->login();
		}
		else
		{
			if(!isset($_GET['id']))
				$_GET['id']=1;

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
		$moreLogicaCodigo = new LogicC();
		return $this->estructura->body(array($moreLogicaCodigo->widget1(),$moreLogicaCodigo->widget2(),$moreLogicaCodigo->widget3()),$contenido);
	}
	
	function Pie()
	{
		return $this->estructura->foot();
	}
}
?>