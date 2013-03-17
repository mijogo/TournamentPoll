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
			$buscarTorneo = new Torneo();
			$buscarTorneo = $buscarTorneo->read();
			for($i=0;$i<count($buscarTorneo);$i++)
			{
				if($buscarTorneo[$i]->getStatus()>0)
				{
					$esteTorneo = $buscarTorneo[$i];
				}
			}
			if($esteTorneo->getStatus() == 1)
			{	
				$text.="No hay acciones disponibles";
			}

			if($esteTorneo->getStatus() == 2)
			{
				$text.=Nominaciones(configuracion("Config","NNominaciones"));
			}
			if($esteTorneo->getStatus() == 3)
			{
				$BatallasActivas = new Batalla();
				$BatallasActivas->setActiva(0);
				$consulta = array("Activa");
				$BatallasActivas = $BatallasActivas->read(true,1,$consulta);
				$text .= "<h6>".fechaHoraActual("Y-m-d")."</h6>
				<h1>Nominaciones</h1>";
				$text1 = "";
				$idBataAr=array();
				for($i=0;$i<count($BatallasActivas);$i++)
				{
					$text1 .= "<h3>Ronda ".$BatallasActivas[$i]->getRonda()." Grupo ".$BatallasActivas[$i]->getGrupo()."<br></h3>";
					$buscarPersonajes = new Personaje();
					$buscarPersonajes->setRonda($BatallasActivas[$i]->getRonda());
					$buscarPersonajes->setGrupo($BatallasActivas[$i]->getGrupo());
					$consulta = array("Ronda","AND","Grupo");
					$buscarPersonajes = $buscarPersonajes->read(true,2,$consulta);
					$secuencia="";
					for($j=0;$j<count($buscarPersonajes);$j++)
					{
						$secuencia .= $buscarPersonajes[$j]->getId();
						if($j+1!=count($buscarPersonajes))
							$secuencia .= "-";
					}
				
					for($j=0;$j<count($buscarPersonajes);$j++)
					{
						$text1 .= botonVoto($BatallasActivas[$i]->getId(),$buscarPersonajes[$j]->getId(),$secuencia,$buscarPersonajes[$j]->getNombre());							
					}
					$idBataAr[] = $BatallasActivas[$i]->getId();
				}
				$text .=  div($text1.formVoto("Votar","?id=4&action=2&trato=2",$idBataAr,configuracion($BatallasActivas[0]->getRonda(),"LimiteVoto")),"","fight");			
			}
		}
		if($_GET['id']==9)
		{
			$batallasF = new Batalla();
			$batallasF->setActiva(1);
			$batallasF = $batallasF->read(true,1,array("Activa"),1,array("Fecha","ASC"));
			for($i=0;$i<count($batallasF);$i++)
			{
				$text1= "Ronda ".$batallasF[$i]->getRonda()." Grupo ".$batallasF[$i]->getGrupo()."<br>";
				$peleasB = new Pelea();
				$peleasB->setIdBatalla($batallasF[$i]->getId());
				$peleasB = $peleasB->read(true,1,array("IdBatalla"),1,array("Votos","DESC"));
				$tableData="";
				$tableData[0][0] = "Pos";				
				$tableData[0][1] = "Nombre";				
				$tableData[0][2] = "Serie";				
				$tableData[0][3] = "Voto";

				for($j=0;$j<count($peleasB);$j++)
				{
					$personajeU = new Personaje();
					$personajeU->setId($peleasB[$j]->getIdPersonaje());
					$personajeU = $personajeU->read(false,1,array("Id"));
					$tableData[$j+1][0]=$j+1;
					$tableData[$j+1][1]=$personajeU->getNombre();
					$tableData[$j+1][2]=$personajeU->getSerie();
					$tableData[$j+1][3]=$peleasB[$j]->getVotos();
				}
				$text1 .= table($tableData);
				$text1 .= "<br>";
				$text .= $text1;
			}
		}	
		if($_GET['id']==10)
		{
			$text=div("","grafV1","","width: 900px; height: 500px;");
			$text.=div("","grafV2","","width: 900px; height: 500px;");
			$text.=div("","grafV3","","width: 900px; height: 500px;");

		}

		return $text;
	}
}
?>