<?php
class LogicC
{
	function LogicC(){}
		
	function trabaja()
	{
		if($_GET['id']==4)
		{
			$nombre = $_POST['Nombre'];
			$serie = $_POST['Serie'];
			$this->inscripcion($nombre,$serie);
			Redireccionar("?id=1");			
		}
	}
		
	function Schedule()
	{
		/*
		number ID
		inscripcion 1,sorteo 2,activar Batalla 3, conteo votos 4
		*/
		$process = new Schedule();
		$process ->setHecho(-1);
		$consulta = array("Hecho");
		$orden = array("Fecha","DESC");
		$process=$process->read(true,1,$consulta,1,$orden); 
		$fechaActual = fechaHoraActual();
		$sigue=true;
		for($i=0;$i<count($process)&&$sigue;$i++)
		{
			if(FechaMayor($fechaActual,$process[$i]->geFecha()))
			{
				if($process[$i]->geAccion()==2)
				{
					$target = explode(",",$process[$i]->geTarget());
					$this->sorteo($target[0],$target[1]);
				}
				if($process[$i]->geAccion()==3)
				{
					$this->activarBatalla($process[$i]->geTarget());
				}
				if($process[$i]->geAccion()==4)
				{
					$this->ConteoVotos();
				}
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
		if($instancia="Preeliminares")
		{
			$personajesSortear = new Personaje();
			$personajesSortear->setInscripcion(1);
			$personajesSortear->setRonda("Nominacion");
			$consulta = array();
			$consulta[] = "Inscripcion";
			$consulta[] = "AND";
			$consulta[] = "Ronda";
			$personajesSortear = $personajesSortear->read(true,2,$consulta);
			$cantidad = count($personajesSortear)/(configuracion("Preeliminares","NGrupos")-$numeroGrupo+1);
			$consultaUp = array();
			$consultaUp [] = "Id";
			$cambio = array();
			$cambio[] = "Ronda";
			$cambio[] = "Grupo";

			for($i=0;$i<$cantidad;$i++)
			{
				do
				{
					$num = rand(0,count($personajesSortear)-1);
					$termino=false;
					if($personajesSortear[$num]->getRonda()=="Nominacion")
					{
						$termino=true;
						$personajesSortear[$num]->setRonda("Preeliminares");
						$personajesSortear[$num]->setGrupo($numeroGrupo);
						$personajesSortear[$num]->update(2,$cambio,1,$consultaUp);
					}
				}while(!$termino);
			}
		}
		if($instancia="Repechaje")
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
			$consultaUp = array();
			$consultaUp [] = "Id";
			$cambio = array();
			$cambio[] = "Grupo";

			for($i=0;$i<$cantidad;$i++)
			{
				do
				{
					$num = rand(0,count($personajesSortear)-1);
					$termino=false;
					if($personajesSortear[$num]->getGrupo()=="NG")
					{
						$termino=true;
						$personajesSortear[$num]->setGrupo($numeroGrupo);
						$personajesSortear[$num]->update(1,$cambio,1,$consultaUp);
					}
				}while(!$termino);
			}
		}
		if($instancia="Principal")
		{
			for($r=0;$r<configuracion("Ronda-1","NBatalla");$r++)
			{
				$personajesSortear = new Personaje();
				$personajesSortear->setRonda("Ronda-1");
				$personajesSortear->setGrupo("NG");			
				$consulta = array();
				$consulta[] = "Grupo";
				$consulta[] = "AND";
				$consulta[] = "Ronda";
				$personajesSortear = $personajesSortear->read(true,2,$consulta);
				$cantidad = count($personajesSortear)/(configuracion("Repechaje","NGrupos")*configuracion("Ronda-1","NBatalla")-(configuracion("Grupo",$numeroGrupo)*configuracion("Repechaje","NGrupos"))-$r);
				$consultaUp = array();
				$consultaUp [] = "Id";
				$cambio = array();
				$cambio[] = "Grupo";

				for($i=0;$i<$cantidad;$i++)
				{
					do
					{
						$num = rand(0,count($personajesSortear)-1);
						$termino=false;
						if($personajesSortear[$num]->getGrupo()=="NG")
						{
							$termino=true;
							if($r<10)
								$termino = "0".$r;
							else
								$termino = $r;
							$personajesSortear[$num]->setGrupo($numeroGrupo."-".$termino);
							$personajesSortear[$num]->update(1,$cambio,1,$consultaUp);
						}
					}while(!$termino);
				}
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
			for($j=0;$j<count($PersonajesContados);$i++)
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
			$consultaPerCh[0]="Id";
			for($j=0;$j<count($dBatalla);$j++)
			{
				if($j < $clas1)
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(true,1,$consultaPerCh);
					$personajeChange->setRonda(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda1"));
					if(configuracion($BatallasActivas[$i]->getRonda(),"grupoFijo"))
					{
						$personajeChange->setGrupo(GenerarSiguiente($personajeChange[$j]->getGrupo,$BatallasActivas[$i]->getRonda()));
					}
					else
						$personajeChange->setGrupo("NG");
					$mod = array("Grupo","Ronda");
					$personajeChange->update(1,$mod,1,$consultaPerCh[0]);
					if($j!=count($dBatalla)-1&&$dBatalla[$j]->getVotos()==$dBatalla[$j+1]->getVotos())
					{
						$clas1++;
						$clas2++;
					}
				}
				else if($j < $clas2)
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(true,1,$consultaPerCh);
					$personajeChange->setRonda(configuracion($BatallasActivas[$i]->getRonda(),"nextRonda2"));
					$personajeChange->setGrupo("NG");
					$mod = array("Grupo","Ronda");
					$personajeChange->update(2,$mod,1,$consultaPerCh[0]);
					if($j!=count($dBatalla)-1&&$dBatalla[$j]->getVotos()==$dBatalla[$j+1]->getVotos())
					{
						$clas2++;
					}
				}
				else
				{
					$personajeChange = new Personaje();
					$personajeChange->setId($dBatalla[$j]->getIdPersonaje());
					$personajeChange = $personajeChange->read(true,1,$consultaPerCh);
					$personajeChange->setEliminada(1);
					$mod = array("Eliminada");
					$personajeChange->update(1,$mod,1,$consultaPerCh[0]);					
				}			
			}
		}
	}
}
?>