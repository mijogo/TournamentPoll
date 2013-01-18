<?php
class LogicV
{
	function LogicV()
	{
	}
	
	function logicaView()
	{
		$text = "";
		if($_GET['id']==3)
		{
			$text1 = "Ingresar una nueva accion";
			
			$values[0][0]=2;
			$values[0][1]="Sorteo";
			$values[1][0]=3;			
			$values[1][1]="Activar Batallas";
			$values[2][0]=5;			
			$values[2][1]="Cambiar Estado Torneo";
			$values[3][0]=6;			
			$values[3][1]="Creacion Batallas";
			
						
			$datos[0][0]="Accion";
			$datos[0][1]=selected("Accion",$values);
			
			$datos[1][0]="Fecha";
			$datos[1][1]=fechaGenerador("Fecha");

			$datos[2][0]="Extra";
			$datos[2][1]=input("Extra","text");

			$datos[3][0]="";
			$datos[3][1]=input("submit","submit");
			$text1 .= table($datos);
			$text .= div(form($text1,"inscipcion","?id=3&action=2"));
			$text1="";
			$valS[0][0]="Accion";
			$valS[0][1]="Fecha";
			$valS[0][2]="Target";
			$valS[0][3]="Hecho";
			
			$datosSchedule = new Schedule();
			$ordenar = array("Fecha","ASC");
			$datosSchedule = $datosSchedule->read(true,0,"",1,$ordenar);
			
			for($i=0;$i<count($datosSchedule);$i++)
			{
				$valS[$i+1][0]=$datosSchedule[$i]->getAccion();
				$valS[$i+1][1]=$datosSchedule[$i]->getFecha();
				$valS[$i+1][2]=$datosSchedule[$i]->getTarget();
				if($datosSchedule[$i]->getHecho()==-1)
					$valS[$i+1][3]="No";
				if($datosSchedule[$i]->getHecho()==1)
					$valS[$i+1][3]="Si";				
			}
			$text1 .= table($valS);
			$text .= div($text1);
		}
		if($_GET['id']==4)
		{			
			$text1 = "Cambie la fecha a una batalla";
			
						
			$datos[0][0]="Id";
			$datos[0][1]=input("Id","text");
			
			$datos[1][0]="Fecha";
			$datos[1][1]=fechaGeneradorwoHora("Fecha");

			$datos[2][0]="";
			$datos[2][1]=input("submit","submit");
			$text1 .= table($datos);
			$text .= div(form($text1,"inscipcion","?id=4&action=2"));

			
			$buscarTorneo = new Torneo();
			$buscarTorneo = $buscarTorneo->read();
			for($i=0;$i<count($buscarTorneo);$i++)
			{
				if($buscarTorneo[$i]->getStatus()>0)
				{
					$esteTorneo = $buscarTorneo[$i];
				}
			}
	
			$text1="";
			$valS[0][0]="Fecha";
			$valS[0][1]="Ronda";
			$valS[0][2]="Grupo";
			$valS[0][3]="Estado";
			$valS[0][4]="Id";
			
			$datoBatalla = new Batalla();
			$datoBatalla->setTorneo($esteTorneo->getId());
			$ordenar = array("Fecha","ASC");
			$consulta = array("Torneo");
			$datoBatalla = $datoBatalla->read(true,1,$consulta,1,$ordenar);
			
			for($i=0;$i<count($datoBatalla);$i++)
			{
				$valS[$i+1][0]=$datoBatalla[$i]->getFecha();
				$valS[$i+1][1]=$datoBatalla[$i]->getRonda();
				$valS[$i+1][2]=$datoBatalla[$i]->getGrupo();
				if($datoBatalla[$i]->getActiva()==-1)
					$valS[$i+1][3]="No Cursado";
				if($datoBatalla[$i]->getActiva()==0)
					$valS[$i+1][3]="Activa";
				if($datoBatalla[$i]->getActiva()==1)
					$valS[$i+1][3]="Finalizado";
				$valS[$i+1][4]=$datoBatalla[$i]->getId();			
			}
			$text1 .= table($valS);
			$text .= div($text1);
		}		
		return $text;
	}
}
?>