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
				$text.="Nominaciones<br>";
				$datos[0][0]="Nombre";
				$datos[0][1]=input("Nombre","text");
				
				$datos[1][0]="Serie";
				$datos[1][1]=input("Serie","text");

				$datos[2][0]="";
				$datos[2][1]=input("submit","submit");
				$text1 = table($datos);
				$text .= form($text1,"inscipcion","?id=4&action=2&trato=1");
			}
			if($esteTorneo->getStatus() == 3)
			{
				$BatallasActivas = new Batalla();
				$BatallasActivas->setActiva(0);
				$consulta = array("Activa");
				$BatallasActivas = $BatallasActivas->read(true,1,$consulta);
				$text .= "Votaciones<br>";
				$text1 = "";
				for($i=0;$i<count($BatallasActivas);$i++)
				{
					$text1 .= "Ronda ".$BatallasActivas[$i]->getRonda()." Grupo ".$BatallasActivas[$i]->getGrupo()."<br>";
					$buscarPersonajes = new Personaje();
					$buscarPersonajes->setRonda($BatallasActivas[$i]->getRonda());
					$buscarPersonajes->setGrupo($BatallasActivas[$i]->getGrupo());
					$consulta = array("Ronda","AND","Grupo");
					$buscarPersonajes = $buscarPersonajes->read(true,2,$consulta);
					$datosPer = "";
					$datosPer[0][0] = "Nombre";
					$datosPer[0][1] = "Serie";
					$datosPer[0][2] = "Vote";					
					for($j=0;$j<count($buscarPersonajes);$j++)
					{
						$datosPer[$j+1][0] = $buscarPersonajes[$j]->getNombre();
						$datosPer[$j+1][1] = $buscarPersonajes[$j]->getSerie();
						$datosPer[$j+1][2] = input($BatallasActivas[$i]->getGrupo()."[]","checkbox",$buscarPersonajes[$j]->getId());								
					}
					$text1 .=  table($datosPer);
				}
				$text1 .=  input("submit","submit");
				$text .= form($text1,"inscipcion","?id=4&action=2&trato=2");			
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
			$text=div("","grafV","","width: 900px; height: 500px;");
		}

		return $text;
	}
}
?>