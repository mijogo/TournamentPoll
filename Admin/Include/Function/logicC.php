<?php
class LogicC
{
	function LogicC(){}
		
	function trabaja()
	{
		if($_GET['id']==-1)
		{
			$nuevoAdmin = new Admin();
			$nuevoAdmin->setUser($_POST['login']);
			$nuevoAdmin->setPass(md5($_POST['password']));
			$nuevoAdmin->setMail($_POST['mail']);
			$nuevoAdmin->setAuthPass(0);
			$nuevoAdmin->setNivel(1);
			$nuevoAdmin->save();
			Redireccionar("?id=0");

		}
		if($_GET['id']==0)
		{
			$nuestrosAdmin = new Admin();
			$nuestrosAdmin = $nuestrosAdmin->read();
			for($i=0;$i<count($nuestrosAdmin);$i++)
			{
				if($nuestrosAdmin[$i]->getUser()==$_POST['login'])
				{

					if($nuestrosAdmin[$i]->getPass()==md5($_POST['password']))
					{ 
						if($nuestrosAdmin[$i]->getAuthPass()==AUTHPASS)
						{
							setcookie("user", $nuestrosAdmin[$i]->getId());
						}
					}
				}
			}
			Redireccionar("?id=1");
		}
		if($_GET['id']==3)
		{
			$Fecha=$_POST['FechaAnio']."-".$_POST['FechaMes']."-".$_POST['FechaDia']." ".$_POST['FechaHora'].":".$_POST['FechaMin'].":".$_POST['FechaSeg'];

			if($_POST['Accion']==2)
			{
				$newSchedule = new schedule();
				$newSchedule->setAccion(2);
				$newSchedule->setFecha($Fecha);
				$newSchedule->setHecho(-1);
				$newSchedule->setTarget($_POST['Extra'].",".$_POST['Extra2']);
				$newSchedule->save();		
			}
			
			if($_POST['Accion']==3)
			{
				$newSchedule = new schedule();
				$newSchedule->setAccion(3);
				$newSchedule->setFecha($Fecha);
				$newSchedule->setHecho(-1);
				$onlyFecha = explode(" ",$Fecha); 
				$newSchedule->setTarget($onlyFecha[0]);
				$newSchedule->save();
				
				$newSchedule = new schedule();
				$newSchedule->setAccion(5);
				$newSchedule->setFecha($Fecha);
				$newSchedule->setHecho(-1);
				$newSchedule->setTarget(3);
				$newSchedule->save();
					
				$newFecha=cambioFecha($Fecha,configuracion("Config","Duracion Batalla"));
				$newSchedule = new schedule();
				$newSchedule->setAccion(5);
				$newSchedule->setFecha($newFecha);
				$newSchedule->setHecho(-1);
				$newSchedule->setTarget(1);
				$newSchedule->save();
				
				$newFecha=cambioFecha($newFecha,configuracion("Config","Extra conteo"));
				$newSchedule = new schedule();
				$newSchedule->setAccion(4);
				$newSchedule->setFecha($newFecha);
				$newSchedule->setHecho(-1);
				$newSchedule->save();
			}
			
			if($_POST['Accion']==5)
			{
				$newSchedule = new schedule();
				$newSchedule->setAccion(5);
				$newSchedule->setFecha($Fecha);
				$newSchedule->setHecho(-1);
				$newSchedule->setTarget($_POST['Extra']);
				$newSchedule->save();
			}
			
			if($_POST['Accion']==6)
			{
				$newSchedule = new schedule();
				$newSchedule->setAccion(6);
				$newSchedule->setFecha($Fecha);
				$newSchedule->setHecho(-1);
				$newSchedule->save();
			}
			Redireccionar("?id=3");
		}
		if($_GET['id']==4)
		{	
			for($r=0;$r<count($_POST['changeBatalla']);$r++)
			{
				$usarBatalla = new Batalla();
				$usarBatalla->setId($_POST['changeBatalla'][$r]);
				$consulta = array("Id");
				$Fecha = $_POST['FechaAnio']."-".$_POST['FechaMes']."-".$_POST['FechaDia'];
				$usarBatalla->setFecha($Fecha);
				$set = array("Fecha");
				$usarBatalla->update(1,$set,1,$consulta);
				Redireccionar("?id=4");
			}
		}
		if($_GET['id']==5)
		{
			for($i=0;$i<count($_POST['changePersonaje']);$i++)
			{
				$chaPer = new Personaje();
				$chaPer->setId($_POST['changePersonaje'][$i]);
				$chaPer->setInscripcion($_POST['change']);
				$chaPer->update(1,array("Inscripcion"),1,array("Id"));
			}
			Redireccionar("?id=5");
		}
		
		if($_GET['id']==1)
		{
			if($_GET['trato']==1)
			{
				$this->creacionBatallas();
				Redireccionar("?id=1");	
			}
			if($_GET['trato']==2)
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
				$batallasU = new Batalla();
				$batallasU->setTorneo($esteTorneo->getId());
				$batallasU = $batallasU->read(true,1,array("Torneo"));
				$fechas=array();
				for($i=0;$i<count($batallasU);$i++)
				{
					$esta=0;
					for($j=0;$j<count($fechas);$j++)
					{
						if($fechas[$j]==$batallasU[$i]->getFecha())
						{
							$esta++;
						}					
					}
					if($esta == 0)
					{
						$fechas[] = $batallasU[$i]->getFecha();
					}
				}
				for($i=0;$i<count($fechas);$i++)
				{
					$CFecha = $fechas[$i]." ".configuracion("Config","Hora Inicio");
					$newSchedule = new schedule();
					$newSchedule->setAccion(3);
					$newSchedule->setFecha($CFecha);
					$newSchedule->setHecho(-1);
					$newSchedule->setTarget($fechas[$i]);
					$newSchedule->save();
					
					$newSchedule = new schedule();
					$newSchedule->setAccion(5);
					$newSchedule->setFecha($CFecha);
					$newSchedule->setHecho(-1);
					$newSchedule->setTarget(3);
					$newSchedule->save();
						
					$newFecha=cambioFecha($CFecha,configuracion("Config","Duracion Batalla"));
					$newSchedule = new schedule();
					$newSchedule->setAccion(5);
					$newSchedule->setFecha($newFecha);
					$newSchedule->setHecho(-1);
					$newSchedule->setTarget(1);
					$newSchedule->save();
					
					$newFecha=cambioFecha($newFecha,configuracion("Config","Extra conteo"));
					$newSchedule = new schedule();
					$newSchedule->setAccion(4);
					$newSchedule->setFecha($newFecha);
					$newSchedule->setHecho(-1);
					$newSchedule->save();
				}
				Redireccionar("?id=1");
			}
		
		}
		if($_GET['id']==6)
		{
			if($_GET['trato']==1)
			{
				$torneoCrear = new Torneo();
				$torneoCrear->setAno($_POST['anio']);
				$torneoCrear->setVersion($_POST['version']);				
				$torneoCrear->setNombre($_POST['nombre']);				
				$torneoCrear->setStatus(0);
				$torneoCrear->save();
				Redireccionar("?id=6");
			}
			else if($_GET['trato']==2)
			{
				$torneoCrear = new Torneo();
				$torneoCrear->setId($_GET['torneo']);
				$torneoCrear = $torneoCrear->read(false,1,array("Id"));
				$torneoCrear->setStatus(1);
				$torneoCrear->update(1,array("Status"),1,array("Id"));
				Redireccionar("?id=6");
			}
		}
		if($_GET['id']==7)
		{
			if($_GET['trato']==2)
			{
				$personajemod = new Personaje();
				$personajemod->setId($_POST['id']);
				$personajemod = $personajemod->read(false,1,array("Id"));
				$personajemod->setNombre($_POST['nombre']);
				$personajemod->setSerie($_POST['serie']);
				$personajemod->setInscripcion($_POST['inscripcion']);
				$personajemod->setEliminada($_POST['eliminada']);
				$personajemod->setGrupo($_POST['grupo']);
				$personajemod->setRonda($_POST['ronda']);
				if($_FILES[ 'imagen' ][ 'tmp_name' ] !="" )
				{
					$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
					$cad = "";
					for($i=0;$i<18;$i++) 
					{
						$cad .= substr($str,rand(0,62),1);
					}
					$tamano = $_FILES [ 'imagen' ][ 'size' ]; 
					$tamaño_max="50000000000";
					if( $tamano < $tamaño_max)
					{ 
						$destino = 'images' ;
						$sep=explode('image/',$_FILES["imagen"]["type"]);
						$tipo=$sep[1];
						if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp" || $tipo == "png" || $tipo == "jpg" || $tipo == "jpeg")
						{
							move_uploaded_file ( $_FILES [ 'imagen' ][ 'tmp_name' ], "../".$destino . '/' .$cad.'.'.$tipo);
							$personajemod->setImagen($destino . '/' .$cad.'.'.$tipo);
						}
						else echo "el tipo de archivo no es de los permitidos";
					}
					else echo "El archivo supera el peso permitido.";
				}
				$personajemod->update(7,array("Nombre","Serie","Inscripcion","Eliminada","Grupo","Ronda","Imagen"),1,array("Id"));
				Redireccionar("?id=7");
			}
		}
	}
		
	function Schedule()
	{
		/*
		number ID
		inscripcion 1,sorteo 2,activar Batalla 3, conteo votos 4,cambiar estado torneo 5,crear Batallas 6
		*/
		$process = new Schedule();
		$process ->setHecho(-1);
		$consulta = array("Hecho");
		$orden = array("Fecha","ASC");
		$process=$process->read(true,1,$consulta,1,$orden); 
		$fechaActual = fechaHoraActual();
		$sigue=true;
		for($i=0;$i<count($process)&&$sigue;$i++)
		{
			if(FechaMayor($fechaActual,$process[$i]->getFecha())!=-1)
			{
				if($process[$i]->getAccion()==2)
				{
					$target = explode(",",$process[$i]->getTarget());
					$this->sorteo($target[0],$target[1]);
				}
				if($process[$i]->getAccion()==3)
				{
					$this->activarBatalla($process[$i]->getTarget());
				}
				if($process[$i]->getAccion()==4)
				{
					$this->ConteoVotos();
				}
				//0 desactivado,1 standby,2 nominaciones,3 batallas activas
				if($process[$i]->getAccion()==5)
				{
					$this->changeChampionship($process[$i]->getTarget());
				}
				if($process[$i]->getAccion()==6)
				{
					$this->creacionBatallas();
				}

				$process[$i]->setHecho(1);
				$con = array("Id");
				$cam = array("Hecho");
				$process[$i]->update(1,$cam,1,$con);
			}
			else
				$sigue=false;
		}
	}
	function inscripcion($Nombre="",$Serie="")
	{
		$nuevoPersonaje = new Personaje();
		$nuevoPersonaje->setNombre($Nombre);
		$nuevoPersonaje->setSerie($Serie);	
		$nuevoPersonaje->setInscripcion(0);	
		$nuevoPersonaje->setEliminada(0);
		$nuevoPersonaje->setGrupo("NG");
		$nuevoPersonaje->setRonda("Nominacion");
		$nuevoPersonaje->save();
	}
	function sorteo($instancia="",$numeroGrupo="")
	{
		if($instancia=="Preeliminares")
		{
			$personajesSortear = new Personaje();
			$personajesSortear->setInscripcion(1);
			$personajesSortear->setRonda("Nominacion");
			$consulta = array("Inscripcion","AND","Ronda");
			$personajesSortear = $personajesSortear->read(true,2,$consulta);
			$cantidad = count($personajesSortear)/(configuracion("Preeliminares","NGrupos")-$numeroGrupo+1);
			$consultaUp = array("Id");
			$cambio = array("Ronda","Grupo");

			for($i=0;$i<$cantidad;$i++)
			{
				do
				{
					$num = rand(0,count($personajesSortear)-1);
					$termino=false;
					if($personajesSortear[$num]->getRonda()=="Nominacion")
					{
						$termino=true;
						if($numeroGrupo<10)
						{
							$grupoPoner = "0".$numeroGrupo;
						}
						else
							$grupoPoner = $numeroGrupo;
						$personajesSortear[$num]->setRonda("Preeliminares");
						$personajesSortear[$num]->setGrupo($grupoPoner);
						$personajesSortear[$num]->update(2,$cambio,1,$consultaUp);
					}
				}while(!$termino);
			}
		}
		if($instancia=="Repechaje")
		{
			$personajesSortear = new Personaje();
			$personajesSortear->setRonda("Repechaje");
			$personajesSortear->setGrupo("NG");			
			$consulta = array();
			$consulta[] = "Grupo";
			$consulta[] = "AND";
			$consulta[] = "Ronda";
			$personajesSortear = $personajesSortear->read(true,2,$consulta);
			$cantidad = count($personajesSortear)/(configuracion("Repechaje","NGrupos")-$numeroGrupo+1);
			$consultaUp = array("Id");
			$cambio = array("Grupo");

			for($i=0;$i<$cantidad;$i++)
			{
				do
				{
					$num = rand(0,count($personajesSortear)-1);
					$termino=false;
					if($personajesSortear[$num]->getGrupo()=="NG")
					{
						$termino=true;
						if($numeroGrupo<10)
						{
							$grupoPoner = "0".$numeroGrupo;
						}
						else
							$grupoPoner = $numeroGrupo;

						$personajesSortear[$num]->setGrupo($grupoPoner);
						$personajesSortear[$num]->update(1,$cambio,1,$consultaUp);
					}
				}while(!$termino);
			}
		}
		if($instancia=="Principal")
		{
			for($r=0;$r<configuracion("Ronda-1","NBatalla");$r++)
			{
				$personajesSortear = new Personaje();
				$personajesSortear->setRonda("Ronda-1");
				$personajesSortear->setGrupo("NG");			
				$consulta = array("Grupo","AND","Ronda");
				$personajesSortear = $personajesSortear->read(true,2,$consulta);
				$cantidad = count($personajesSortear)/(configuracion("Ronda-1","NGrupos")*configuracion("Ronda-1","NBatalla")-(configuracion("Grupo",$numeroGrupo)*configuracion("Ronda-1","NBatalla"))-$r);
				$consultaUp = array("Id");
				$cambio = array("Grupo");
				for($i=0;$i<$cantidad;$i++)
				{
					do
					{
						$num = rand(0,count($personajesSortear)-1);
						$termino=false;
						if($personajesSortear[$num]->getGrupo()=="NG")
						{
							$termino=true;
							if($r<9)
								$termino = "0".($r+1);
							else
								$termino = ($r+1);
							$personajesSortear[$num]->setGrupo($numeroGrupo."-".$termino);
							$personajesSortear[$num]->update(1,$cambio,1,$consultaUp);
						}
					}while(!$termino);
				}
			}
		}
		if($instancia=="Final")
		{
			$personajesSortear = new Personaje();
			$personajesSortear->setRonda("Final-1");
			$personajesSortear->setGrupo("NG");			
			$consulta = array();
			$consulta[] = "Grupo";
			$consulta[] = "AND";
			$consulta[] = "Ronda";
			$personajesSortear = $personajesSortear->read(true,2,$consulta);
			$cantidad = count($personajesSortear)/(configuracion("Final-1","NGrupos")-$numeroGrupo+1);
			$consultaUp = array("Id");
			$cambio = array("Grupo");

			for($i=0;$i<$cantidad;$i++)
			{
				do
				{
					$num = rand(0,count($personajesSortear)-1);
					$termino=false;
					if($personajesSortear[$num]->getGrupo()=="NG")
					{
						$termino=true;
						if($numeroGrupo<10)
						{
							$grupoPoner = "0".$numeroGrupo;
						}
						else
							$grupoPoner = $numeroGrupo;

						$personajesSortear[$num]->setGrupo($grupoPoner);
						$personajesSortear[$num]->update(1,$cambio,1,$consultaUp);
					}
				}while(!$termino);
			}
		}		
	}
	
	function activarBatalla($fecha)
	{
		$vamosBatallas = new Batalla();
		$vamosBatallas->setActiva(-1);
		$vamosBatallas->setFecha($fecha);
		$consulta[0]="Activa";
		$consulta[1]="AND";
		$consulta[2]="Fecha";		
		$vamosBatallas = $vamosBatallas->read(true,2,$consulta);
		$consultaUP[0]="Id";
		$set[0]="Activa";
		for($i=0;$i<count($vamosBatallas);$i++)
		{
			$vamosBatallas[$i]->setActiva(0);
			$vamosBatallas[$i]->update(1,$set,1,$consultaUP);
		}	
	}
	
	function ConteoVotos()
	{
		$BatallasActivas=new Batalla();
		$BatallasActivas->setActiva(0);
		$consulta[0]="Activa";
		$consltaPer[0]="Grupo";
		$consltaPer[1]="AND";
		$consltaPer[2]="Ronda";
		$cinsultaextra[0] = "IdBatalla";
		$ordenVoto[0]="Votos";
		$ordenVoto[1]="DESC";
		$BatallasActivas = $BatallasActivas->read(true,1,$consulta);
		for($i=0;$i<count($BatallasActivas);$i++)
		{
			$PersonajesContados = new Personaje();
			$PersonajesContados->setGrupo($BatallasActivas[$i]->getGrupo());
			$PersonajesContados->setRonda($BatallasActivas[$i]->getRonda());
			$PersonajesContados=$PersonajesContados->read(true,2,$consltaPer);
			for($j=0;$j<count($PersonajesContados);$j++)
			{
				$ConVoto = new Voto();
				$ConVoto->setIdBatalla($BatallasActivas[$i]->getId());
				$ConVoto->setIdPersonaje($PersonajesContados[$j]->getId());
				$consultaVoto[0]="IdBatalla";
				$consultaVoto[1]="AND";
				$consultaVoto[2]="IdPersonaje";
				$ConVoto = $ConVoto->read(true,2,$consultaVoto);
				$nuevaPelea = new Pelea();
				$nuevaPelea->setIdPersonaje($PersonajesContados[$j]->getId());
				$nuevaPelea->setIdBatalla($BatallasActivas[$i]->getId());
				$nuevaPelea->setVotos(count($ConVoto));
				$nuevaPelea->save();
			}
			$dBatalla = new Pelea();
			$dBatalla->setIdBatalla($BatallasActivas[$i]->getId());
			$dBatalla = $dBatalla->read(true,1,$cinsultaextra,1,$ordenVoto);
			$clas1 = configuracion($BatallasActivas[$i]->getRonda(),"clas1");
			if(configuracion($BatallasActivas[$i]->getRonda(),"second"))
				$clas2 = configuracion($BatallasActivas[$i]->getRonda(),"clas2");
			else
				$clas2 = 0;
			$consultaPerCh=array("Id");
			for($j=0;$j<count($dBatalla);$j++)
			{
				if($j < $clas1)
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(false,1,$consultaPerCh);
					$personajeChange->setRonda(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda1"));
					if(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda1")=="Termino")
						$personajeChange->setGrupo("Campeona");
					else if(configuracion(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda1"),"grupoFijo"))
					{
						$personajeChange->setGrupo(GenerarSiguiente($personajeChange->getGrupo(),$BatallasActivas[$i]->getRonda()));
					}
					else
						$personajeChange->setGrupo("NG");
					$mod = array("Grupo","Ronda");
					$personajeChange->update(2,$mod,1,$consultaPerCh);
					if($j!=count($dBatalla)-1&&$dBatalla[$j]->getVotos()==$dBatalla[$j+1]->getVotos()&&$j+1==$clas1)
					{
						$clas1++;
						$clas2++;
					}
				}
				else if($j < $clas2)
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(false,1,$consultaPerCh);
					$personajeChange->setRonda(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda2"));
					$personajeChange->setGrupo("NG");
					$mod = array("Grupo","Ronda");
					$personajeChange->update(2,$mod,1,$consultaPerCh);
					if($j!=count($dBatalla)-1&&$dBatalla[$j]->getVotos()==$dBatalla[$j+1]->getVotos()&&$j+1==$clas2)
					{
						$clas2++;
					}
				}
				else
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(false,1,$consultaPerCh);
					$personajeChange->setEliminada(1);
					$mod = array("Eliminada");
					$personajeChange->update(1,$mod,1,$consultaPerCh);					
				}			
			}
			$BatallasActivas[$i]->setActiva(1);
			$setBatalla = array("Activa");
			$consultaBatalla = array("Id");
			$BatallasActivas[$i]->update(1,$setBatalla,1,$consultaBatalla);
		}
	}
	
	function changeChampionship($newStatus)
	{
		$buscarTorneo = new Torneo();
		$buscarTorneo = $buscarTorneo->read();
		for($i=0;$i<count($buscarTorneo);$i++)
		{
			if($buscarTorneo[$i]->getStatus()>0)
			{
				$set=array("Status");
				$con=array("Id");
				$buscarTorneo[$i]->setStatus($newStatus);
				$buscarTorneo[$i]->update(1,$set,1,$con);
			}
		}
	}
	
	function creacionBatallas()
	{
		$IdToneo=0;
		$buscarTorneo = new Torneo();
		$buscarTorneo = $buscarTorneo->read();
		for($i=0;$i<count($buscarTorneo);$i++)
		{
			if($buscarTorneo[$i]->getStatus()>0)
			{
				$IdToneo = $buscarTorneo[$i]->getId();
			}
		}
		
		$instancia = "Preliminares";
		$sigue = true;		
		$fecha = "2013-01-01";
		while($sigue)
		{
			$cantidad = configuracion($instancia,"NGrupos");
			if($instancia=="Preeliminares"||$instancia=="Repechaje"||$instancia=="Final-1"||$instancia=="Final-2"||$instancia=="Final-3"||$instancia=="Final-4")
			{
				for($i=0;$i<$cantidad;$i++)
				{
					$nuevaBatalla = new Batalla();
					$nuevaBatalla->setFecha($fecha);
					$nuevaBatalla->setRonda($instancia);
					if($i<9)
						$grupo = "0".($i+1);
					else
						$grupo = $i+1;
					$nuevaBatalla->setGrupo($grupo);
					$nuevaBatalla->setTorneo($IdToneo);
					$nuevaBatalla->setActiva(-1);
					$nuevaBatalla->save();
				}
			}
			else
			{
				$cantidadBatalla = configuracion($instancia,"NBatalla");
				for($i=0;$i<$cantidad;$i++)
				{
					for($j=0;$j<$cantidadBatalla;$j++)
					{
						$nuevaBatalla = new Batalla();
						$nuevaBatalla->setFecha($fecha);
						$nuevaBatalla->setRonda($instancia);
						if($j<9)
							$grupo = "0".($j+1);
						else
							$grupo = $j+1;
						$nuevaBatalla->setGrupo(configuracion("Rev Grupo",$i)."-".$grupo);
						$nuevaBatalla->setTorneo($IdToneo);
						$nuevaBatalla->setActiva(-1);
						$nuevaBatalla->save();
					}		
				}
			}
			if($instancia =="Termino")
			 	$sigue=false;

			if(configuracion($instancia,"second"))
				$instancia = configuracion($instancia,"nextRonda2");
			else 
				$instancia = configuracion($instancia,"nextRonda1");
		}
	}
	
	function datosGrafo($batalla,$intervalo,$horaInicio,$horaLimite,$limitePersonaje)
	{
		$batallaActual = new Batalla();
		$batallaActual->setId($batalla);
		$batallaActual = $batallaActual->read(false,1,array("Id"));
		
		if($batallaActual->getActiva()==0)
			$enAccion=true;
		else
			$enAccion=false;

		if($enAccion)
		{
			
			$personajeProbar = new Personaje();
			$personajeProbar->setRonda($batallaActual->getRonda());
			$personajeProbar->setGrupo($batallaActual->getGrupo());
			$personajeProbar = $personajeProbar->read(true,2,array("Ronda","AND","Grupo"));
			
			for($i=0;$i<count($personajeProbar);$i++)
			{
				$cantVotos[$i]["Id"]=$personajeProbar[$i]->getId();
				$cantVotos[$i]["Votos"]=0;	
			}
			
			$votosContar = new Voto();
			$votosContar->setIdBatalla($batalla);
			$votosContar = $votosContar->read(true,1,array("IdBatalla"),1,array("Fecha","ASC"));
			
			for($i=0;$i<count($votosContar);$i++)
			{
				$esta = false;
				for($j=0;$j<count($cantVotos)&&!$esta;$j++)
				{
					if($votosContar[$i]->getIdPersonaje() == $cantVotos[$j]["Id"])
					{
						$cantVotos[$j]["Votos"]++;
						$esta=true;
					}
				}
			}
		}
		else
		{			
			$personajeProbar = new Pelea();
			$personajeProbar->setIdBatalla($batallaActual->getId());
			$personajeProbar = $personajeProbar->read(true,1,array("IdBatalla"));
			
			for($i=0;$i<count($personajeProbar);$i++)
			{
				$cantVotos[$i]["Id"]=$personajeProbar[$i]->getIdPersonaje();
				$cantVotos[$i]["Votos"]=0;	
			}
			
			$votosContar = new Voto();
			$votosContar->setIdBatalla($batalla);
			$votosContar = $votosContar->read(true,1,array("IdBatalla"),1,array("Fecha","ASC"));
			
			for($i=0;$i<count($votosContar);$i++)
			{
				$esta = false;
				for($j=0;$j<count($cantVotos)&&!$esta;$j++)
				{
					if($votosContar[$i]->getIdPersonaje() == $cantVotos[$j]["Id"])
					{
						$cantVotos[$j]["Votos"]++;
						$esta=true;
					}
				}
			}
		}
		$cambio =true;
		for($i=0;$i<count($cantVotos)&& $cambio;$i++)
		{
			$cambio =false;
			for($j=0;$j<count($cantVotos)-1;$j++)
			{
				if($cantVotos[$j]["Votos"]<$cantVotos[$j+1]["Votos"])
				{
					$cambio=true;
					$temp=$cantVotos[$j];
					$cantVotos[$j] = $cantVotos[$j+1];
					$cantVotos[$j+1] = $temp;
				}
			}
		}
		
		$titulos = array();
		$titulos[] = "Hora";
		for($u=0;$u<count($cantVotos)&&$u<$limitePersonaje;$u++)
		{
			$personajeAv = new Personaje();
			$personajeAv->setId($cantVotos[$u]["Id"]);
			$personajeAv = $personajeAv->read(false,1,array("Id"));
			
			$titulos[] = $personajeAv->getNombre();
		}
		
		$Fecha = $batallaActual->getFecha()." ".$horaInicio;
		$FechaLimite = cambioFecha($Fecha,$horaLimite);
		$datosGeneral[0][0]=$horaInicio;
		for($u=1;$u<count($titulos);$u++)	
		{
			$datosGeneral[0][$u]=0;
		}
		$sigue=true;
		$i=0;
		$j=1;
		while($sigue&&$j<100)
		{
			$Fecha = cambioFecha($Fecha,$intervalo);

			$datosGeneral[$j]=$datosGeneral[$j-1];
			$hora=explode(" ",$Fecha);
			$datosGeneral[$j][0]=$hora[1];
			$sigue2=true;
			while($sigue2)
			{
				if(count($votosContar)!=$i&&FechaMayor($Fecha,$votosContar[$i]->getFecha())!=-1)
				{
					$vamos=true;
					for($k=0;$k<count($titulos)-1&&$vamos;$k++)
					{
						if($cantVotos[$k]["Id"]==$votosContar[$i]->getIdPersonaje())
						{
							$vamos=false;
							$datosGeneral[$j][$k+1]++;
						}
					}
					$i++;
				}
				else
					$sigue2=false;
			}
			if((count($votosContar)==$i&&$enAccion)||FechaMayor($Fecha,$FechaLimite)!=-1)
			{
				$sigue=false;
				
			}
			$j++;
		}

		$retornar = array();
		$retornar[] = $titulos;
		$retornar[] = $datosGeneral;
		return $retornar;
	}
	
		function widget1()
	{
		$buscarTorneo = new Torneo();
		$buscarTorneo = $buscarTorneo->read();
		$hay = 0;
		$text = "<h5>Last Match Result</h5>";
		for($i=0;$i<count($buscarTorneo);$i++)
		{
			if($buscarTorneo[$i]->getStatus()>0)
			{
				$esteTorneo = $buscarTorneo[$i];
				$hay++;
			}
		}
		$text1="";
		if($hay>0)
		{
			$BBatalla = new Batalla();
			$BBatalla->setTorneo($esteTorneo->getId());
			$BBatalla->setActiva(1);
			$BBatalla = $BBatalla->read(true,2,array("Torneo","AND","Activa"),1,array("Fecha","DESC"));
			if(count($BBatalla)>0)
			{
				$fechaCuenta = $BBatalla[0]->getFecha();
				$i=0;
				while(count($BBatalla)>$i&&$fechaCuenta==$BBatalla[$i]->getFecha())
				{
					$text1 .= "<h5>".$BBatalla[$i]->getRonda()."  ".$BBatalla[$i]->getGrupo()."</h5>";
					$peleasB = new Pelea();
					$peleasB->setIdBatalla($BBatalla[$i]->getId());
					$peleasB = $peleasB->read(true,1,array("IdBatalla"),1,array("Votos","DESC"));
					for($j=0;$j<count($peleasB);$j++)
					{
						$personaje = new Personaje();
						$personaje->setId($peleasB[$j]->getIdPersonaje());
						$personaje = $personaje->read(false,1,array("Id"));
						$datos[$j][0]=$personaje->getNombre();
						$datos[$j][1]=$peleasB[$j]->getVotos();
					}
					$i++;

					$text1 .= table($datos,"0-200");
				}
				$text .= div($text1,"","fight");
			}
			else
				$text .= div("No han habido enfrentamientos aun","","fight");
		}
		else
			$text .= div("Aun no ha comenzado este torneo","","fight");
		return $text;
	}
	function widget2()
	{
		$text ="";
		$text .= "<h5>Next Event</h5>";
		$text .= "<div class=\"fight\">Miss Anime Tournament 2013<br/>";
		$reSchedule = new Schedule();
		$reSchedule->setHecho(-1);
		$reSchedule = $reSchedule->read(true,1,array("Hecho"),1,array("Fecha","ASC"));
		if(count($reSchedule)!=0)
		{
			$Sale = false;
			$i=0;
			while(!$Sale && $i<count($reSchedule))
			{
				if($reSchedule[$i]->getAccion()==5)
				{
					if($reSchedule[$i]->getTarget()==2)
					{
						$text .= "Nominations<br/>
						".$reSchedule[$i]->getFecha()."<br/>";
						$Sale=true;
					}
				}
				elseif($reSchedule[$i]->getAccion()==2)
				{
					$Deque = explode(",",$reSchedule[$i]->getTarget());
					$text .= "Sorteo<br/>
					Ronda ".$Deque[0]." Grupo ".$Deque[1]."<br/>
						".$reSchedule[$i]->getFecha()."<br/>";
					$Sale=true;
				}
				elseif($reSchedule[$i]->getAccion()==3)
				{
					$text .= "Enfrentamiento<br/>
						".$reSchedule[$i]->getFecha()."<br/>";
					$Enfrentamiento = new Batalla();
					$Enfrentamiento->setFecha($reSchedule[$i]->getFecha());
					$Enfrentamiento = $Enfrentamiento->read(true,1,array("Fecha"));
					for($k=0;$k<count($Enfrentamiento);$k++)
					{
						$text .= "<h5>".$Enfrentamiento[$k]->getRonda()."  ".$Enfrentamiento[$k]->getGrupo()."</h5>";
						$personajesBR = new Personaje();
						$personajesBR->setRonda($Enfrentamiento[$k]->getRonda());
						$personajesBR->setGrupo($Enfrentamiento[$k]->getGrupo());
						$personajesBR=$personajesBR->read(true,2,array("Ronda","AND","Grupo"));
						for($j=0;$j<count($personajesBR);$j++)
						{
							$text .= $personajesBR[$j]->getNombre()."(".$personajesBR[$j]->getSerie().")</br>";
						}
					}
					$Sale=true;
				}
				$i++;
			}
			if($i==count($reSchedule))
			{
				$text .= "No hay eventos disponibles<br/>";
			}
		}
		else
		{
			$text .= "No hay eventos disponibles<br/>";
		}
		$text .= "</div>";
		return $text;
	}
	
	function widget3()
	{
	$text = "<h5>Current Time (GMT)</h5>
<div class=\"fight\"><table><tr><td id=\"Fecha_Reloj\"></td></tr></table></div>
";
	return $text;
	}


}
?>