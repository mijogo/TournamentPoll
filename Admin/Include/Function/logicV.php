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
		if($_GET['id']==6)
		{
			$text.="<H1>Crear Torneo</H1>";
			$text1="";
			$valS[0][0]="Año";
			$valS[0][1]=input("anio","text");
			$valS[1][0]="Version";
			$valS[1][1]=input("version","text");
			$valS[2][0]="Nombre";
			$valS[2][1]=input("nombre","text");
			$valS[3][0]="";
			$valS[3][1]=input("Enviar","submit","Crear","subboto");

			$text1 .= table($valS,"0-150;1-200");
			$text .= div(form($text1,"Torneo","?id=6&action=2&trato=1"),"","fight");
			$text1="";
			$text.="<H1>Seleccionar Torneo</H1>";
			$torneosB=new Torneo();
			$torneosB = $torneosB->read();
			$rasD[0][0] = "Nombre";
			$rasD[0][1] = "Version";			
			$rasD[0][2] = "Año";	
			$rasD[0][3] = "Estado";
			$rasD[0][4] = "Seleccionar";
			for($i=0;$i<count($torneosB);$i++)
			{
				$rasD[$i+1][0] = $torneosB[$i]->getNombre();				
				$rasD[$i+1][1] = $torneosB[$i]->getVersion();			
				$rasD[$i+1][2] = $torneosB[$i]->getAno();
				if( $torneosB[$i]->getStatus()==0)
				{
					$rasD[$i+1][3] = "Inactivo";			
					$rasD[$i+1][4] = input("Enviar","button","Seleccionar","opcionesBoton","onclick=\"cambiar(".$torneosB[$i]->getId().")\"");
				}
				else if( $torneosB[$i]->getStatus()==1)
					$rasD[$i+1][3] = "Activo";
				else if( $torneosB[$i]->getStatus()==2)
					$rasD[$i+1][3] = "Nominaciones";
				else if( $torneosB[$i]->getStatus()==3)
					$rasD[$i+1][3] = "Batalla Activa";
			}
			$text1 .= table($rasD,"0-120;1-50;2-50;3-100");
			$text .= div($text1,"","fight");

		}
		
		if($_GET['id']==7)
		{
			if(!isset($_GET['trato']))
				$_GET['trato']=1;
			if($_GET['trato']==1)
			{
				$text1="";
				$text.="<H1>Modificar Personaje</H1>";
				$PersonajeM=new Personaje();
				$PersonajeM= $PersonajeM->read(true,0,"",1,array("Inscripcion","DESC"));
				$rasD[0][0] = "Nombre";
				$rasD[0][1] = "Serie";			
				$rasD[0][2] = "Imagen";	
				$rasD[0][3] = "Inscrito";
				$rasD[0][4] = "Seleccionar";
				for($i=0;$i<count($PersonajeM);$i++)
				{
					$rasD[$i+1][0] = $PersonajeM[$i]->getNombre();				
					$rasD[$i+1][1] = $PersonajeM[$i]->getSerie();
					if($PersonajeM[$i]->getImagen()=="")		
						$rasD[$i+1][2] = "No";
					else
						$rasD[$i+1][2] = "Si";
					if($PersonajeM[$i]->getInscripcion()==1)		
						$rasD[$i+1][3] = "Si";
					else
						$rasD[$i+1][3] = "No";				
					$rasD[$i+1][4] = input("Enviar","button","Modificar","subboto","onclick=\"modificar(".$PersonajeM[$i]->getId().")\"");
				}
				$text1 .= table($rasD,"0-80;1-80;2-40;3-40");
				$text .= div($text1,"","fight");
	
			}
			elseif($_GET['trato']==2)
			{
				$text.="<H1>Modificar Personaje</H1>";
				$text1="";
				$personajemod = new Personaje();
				$personajemod->setId($_GET['personaje']);
				$personajemod = $personajemod->read(false,1,array("Id"));
				$valS[0][0]="Nombre";
				$valS[0][1]=input("nombre","text",$personajemod->getNombre());
				$valS[1][0]="Serie";
				$valS[1][1]=input("serie","text",$personajemod->getSerie());
				$valS[2][0]="Inscripcion";
				$valS[2][1]=input("inscripcion","text",$personajemod->getInscripcion());
				$valS[3][0]="Eliminada";
				$valS[3][1]=input("eliminada","text",$personajemod->getEliminada());
				$valS[4][0]="Grupo";
				$valS[4][1]=input("grupo","text",$personajemod->getGrupo());
				$valS[5][0]="Ronda";
				$valS[5][1]=input("ronda","text",$personajemod->getRonda());
				$valS[6][0]="Imagen";
				$valS[6][1]=input("imagen","file",$personajemod->getRonda());

				$valS[7][0]="";
				$valS[7][1]=input("Enviar","submit","Modificar","subboto");

				$text1 .= table($valS,"0-150;1-200").input("id","hidden",$_GET['personaje']);
				$text .= div(form($text1,"Torneo","?id=7&action=2&trato=2","enctype=\"multipart/form-data\"").img("../".$personajemod->getImagen()),"","fight");
			}
		}
		if($_GET['id']==8)
		{
			$text .= "<h1>Crear Batalla de Exhibicion</h1>";
			$text1="";
			$datos[0][0]="Fecha";
			$datos[0][1]=fechaGeneradorwoHora("Fecha");

			$datos[1][0]="";
			$datos[1][1]=input("Enviar","submit","Crear","subboto");
			$text1 .= table($datos);
			$text .= div(form($text1,"Torneo","?id=8&action=2"),"","fight");
			$text .= "En Contruccion";
		}
		return $text;
	}
	
}
?>