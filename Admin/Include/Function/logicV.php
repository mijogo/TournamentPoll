<?php
class LogicV
{
	function LogicV()
	{
	}
	
	function logicaView()
	{
		$text = "";
		if($_GET['id']==1)
		{
			$text .= div(input("Enviar","button","Crear Batallas","opcionesBoton","onclick=\"hacer(1)\""),"","fight");
			$text .= div(input("Enviar","button","Poner Fecha Batalla","opcionesBoton","onclick=\"hacer(2)\""),"","fight");
		}
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
			$datos[0][1]=selected("Accion",$values,"onclick=\"mod()\"");
			
			$datos[1][0]="Fecha";
			$datos[1][1]=fechaGenerador("Fecha");
			
			$datos[2][0]="Extra";
			$value2[0][0]="Preeliminares";
			$value2[0][1]="Preeliminares";
			$value2[1][0]="Repechaje";
			$value2[1][1]="Repechaje";
			$value2[2][0]="Principal";
			$value2[2][1]="Principal";
			$value2[3][0]="Final";
			$value2[3][1]="Final";

			$datos[2][1]=div(selected("Extra",$value2)." Grupo ".input("text","Extra2"),"Modi");

			$datos[3][0]="";
			$datos[3][1]=input("Enviar","submit","Enviar","subboto");
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
			
						
			//$datos[0][0]="Id";
			//$datos[0][1]=input("Id","text");
			
			$datos[0][0]="Fecha";
			$datos[0][1]=fechaGeneradorwoHora("Fecha");

			$datos[1][0]="";
			$datos[1][1]=input("Enviar","submit","Cambiar","subboto");
			$text1 .= table($datos);


			
			$buscarTorneo = new Torneo();
			$buscarTorneo = $buscarTorneo->read();
			for($i=0;$i<count($buscarTorneo);$i++)
			{
				if($buscarTorneo[$i]->getStatus()>0)
				{
					$esteTorneo = $buscarTorneo[$i];
				}
			}
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
				$valS[$i+1][5]=input("changeBatalla[]","checkbox",$datoBatalla[$i]->getId());	
			}
			$text1 .= table($valS,"0-80;1-100;2-50;3-80;4-40;5-20");
			$text .= div(form($text1,"inscipcion","?id=4&action=2"));
			//$text .= div($text0);
		}		
		
		if($_GET['id']==5)
		{		
			$opciones[0][0]=-1;	
			$opciones[0][1]="Rechazada";
			$opciones[1][0]=0;
			$opciones[1][1]="Pendiente";
			$opciones[2][0]=1;
			$opciones[2][1]="Aceptada";
			$text = "Ver Nominaciones";
			
	$valS="";
			$text1="Pendientes";
			$valS[0][0]="Nombre";
			$valS[0][1]="Serie";
			$valS[0][2]="Cambio";
			
			$datoPersonaje = new Personaje();
			$datoPersonaje->setInscripcion(0);
			$datoPersonaje= $datoPersonaje->read(true,1,array("Inscripcion"));
			
			for($i=0;$i<count($datoPersonaje);$i++)
			{
				$valS[$i+1][0]=$datoPersonaje[$i]->getNombre();	
				$valS[$i+1][1]=$datoPersonaje[$i]->getSerie();	
				$valS[$i+1][2]=input("changePersonaje[]","checkbox",$datoPersonaje[$i]->getId());	
			}


			$text1 .= table($valS);
			$text1 .= selected("change",$opciones);
			$text1 .= input("submit","submit");

			$text .= div(form($text1,"inscipcion","?id=5&action=2"));
			$text .= "<br><br>";
			$valS="";
			$text1="Aceptadas";
			$valS[0][0]="Nombre";
			$valS[0][1]="Serie";
			$valS[0][2]="Cambio";
			
			$datoPersonaje = new Personaje();
			$datoPersonaje->setInscripcion(1);
			$datoPersonaje= $datoPersonaje->read(true,1,array("Inscripcion"));
			
			for($i=0;$i<count($datoPersonaje);$i++)
			{
				$valS[$i+1][0]=$datoPersonaje[$i]->getNombre();	
				$valS[$i+1][1]=$datoPersonaje[$i]->getSerie();	
				$valS[$i+1][2]=input("changePersonaje[]","checkbox",$datoPersonaje[$i]->getId());	
			}


			$text1 .= table($valS);
			$text1 .= selected("change",$opciones);
			$text1 .= input("submit","submit");

			$text .= div(form($text1,"inscipcion","?id=5&action=2"));
			$text .= "<br><br>";
			$valS="";
			$text1="Rechazadas";
			$valS[0][0]="Nombre";
			$valS[0][1]="Serie";
			$valS[0][2]="Cambio";
			
			$datoPersonaje = new Personaje();
			$datoPersonaje->setInscripcion(-1);
			$datoPersonaje= $datoPersonaje->read(true,1,array("Inscripcion"));
			
			for($i=0;$i<count($datoPersonaje);$i++)
			{
				$valS[$i+1][0]=$datoPersonaje[$i]->getNombre();	
				$valS[$i+1][1]=$datoPersonaje[$i]->getSerie();	
				$valS[$i+1][2]=input("changePersonaje[]","checkbox",$datoPersonaje[$i]->getId());	
			}


			$text1 .= table($valS);
			$text1 .= selected("change",$opciones);
			$text1 .= input("submit","submit");

			$text .= div(form($text1,"inscipcion","?id=5&action=2"));
			$text .= "<br><br>";

		}		
		return $text;
	}
}
?>