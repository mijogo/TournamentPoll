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
		if($_GET['id']==1)
		{
			$IdToneo=0;
			$buscarTorneo = new Torneo();
			$buscarTorneo = $buscarTorneo->read();
			$hay=0;
			for($i=0;$i<count($buscarTorneo);$i++)
			{
				if($buscarTorneo[$i]->getStatus()>0)
				{
					$esteTorneo = $buscarTorneo[$i];
					$hay++;
				}
			}
			
			if($hay!=0&&$esteTorneo->getStatus()==3)
			{
				$cualesBatalla = new Batalla();
				$cualesBatalla->setActiva(0);
				$cualesBatalla = $cualesBatalla->read(true,1,array("Activa"));

				$moreLogicaCodigo = new LogicC();
				$text2="";
				for($i=0;$i<count($cualesBatalla);$i++)
				{
					$datos1=$moreLogicaCodigo->datosGrafo($cualesBatalla[$i]->getId(),configuracion("Config","Intervalo"),configuracion("Config","Hora Inicio"),configuracion("Config","Duracion Live"),configuracion("Config","Max Miembros Grafo"));
					$text2.=grafico("Grupo ".$cualesBatalla[$i]->getGrupo(),"graf".$cualesBatalla[$i]->getId(),$datos1[0],$datos1[1]);
				}
				return $this->estructura->head("Certamen Brolicones",$text2);
			}
			else
			{
				return $this->estructura->head("Certamen Brolicones");
			}
		}
		elseif($_GET['id']==9)
		{
			if(isset($_GET['trato'])&&$_GET['trato']==2)
			{
				$utilLogic = new logicC();
				$batallasB = new Batalla();
				$batallasB->setRonda($_GET['instancia']);
				$instancia = $_GET['instancia'];
				$grupo = $_GET['grupo'];
				$batallasB = $batallasB->read(true,1,array("Ronda"));
				$moreLogicaCodigo = new LogicC();
				$text2="";
	
				for($i=0;$i<count($batallasB);$i++)
				{
					if($instancia=="Ronda-1"||$instancia=="Ronda-2"||$instancia=="Ronda-3"||$instancia=="Ronda-4"||$instancia=="Ronda-5")
					{
						if(substr($batallasB[$i]->getGrupo(),0,1)==$grupo)
						{
							if($batallasB[$i]->getActiva()==1)
							{
								$datos1=$moreLogicaCodigo->datosGrafo($batallasB[$i]->getId(),configuracion("Config","Intervalo"),configuracion("Config","Hora Inicio"),configuracion("Config","Duracion Batalla"),configuracion("Config","Max Miembros Grafo"));
								$text2.=grafico("Grupo ".$batallasB[$i]->getGrupo(),"graf".$batallasB[$i]->getId(),$datos1[0],$datos1[1]);
							}
						}
					}
					else
					{
						if($batallasB[$i]->getGrupo()==$grupo)
						{
							if($batallasB[$i]->getActiva()==1)
							{
								$datos1=$moreLogicaCodigo->datosGrafo($batallasB[$i]->getId(),configuracion("Config","Intervalo"),configuracion("Config","Hora Inicio"),configuracion("Config","Duracion Batalla"),configuracion("Config","Max Miembros Grafo"));
								$text2.=grafico("Grupo ".$batallasB[$i]->getGrupo(),"graf".$batallasB[$i]->getId(),$datos1[0],$datos1[1]);							
							}
						}
					}
				}
				return $this->estructura->head("Certamen Brolicones",$text2);
			}
			else
				return $this->estructura->head("Certamen Brolicones");

		}
		else
			return $this->estructura->head("Certamen Brolicones");
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