<?php
class ScheduleW
{
	function ScheduleW(){}
	
	function run()
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
				if($process[$i]->getAccion()==5)
				{
					$this->changeChampionship($process[$i]->getTarget());
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
	
	function sorteo($instancia="",$numeroGrupo="")
	{
		if($instancia=="Preliminares")
		{
			$personajesSortear = new Personaje();
			$personajesSortear->setInscripcion(1);
			$personajesSortear->setRonda("Nominacion");
			$consulta = array("Inscripcion","AND","Ronda");
			$personajesSortear = $personajesSortear->read(true,2,$consulta);
			$cantidad = count($personajesSortear)/(configuracion("Preliminares","NGrupos")-$numeroGrupo+1);
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
						$personajesSortear[$num]->setRonda("Preliminares");
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
			$personajesSortear->setRonda("Ronda-1");
			$personajesSortear = $personajesSortear->read(true,1,array("Ronda"));
			$Total = count($personajesSortear);
			$batallas = configuracion("Ronda-1","NBatalla")*configuracion("Ronda-1","NGrupos");
			$PPM = floor($personajesSortear/$batallas);
			$sobra = $Total-($PPM*$batallas);
			
			for($r=0;$r<configuracion("Ronda-1","NBatalla");$r++)
			{
				$personajesSortear = new Personaje();
				$personajesSortear->setRonda("Ronda-1");
				$personajesSortear->setGrupo("NG");			
				$personajesSortear = $personajesSortear->read(true,2,array("Grupo","AND","Ronda"));
				
				$cantidad = $PPM;
				if($sobra> ($r*configuracion("Ronda-1","NBatalla")+configuracion("Grupo","$numeroGrupo")))
					$cantidad++;
				
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
							$personajesSortear[$num]->update(1,array("Grupo"),1,array("Id"));
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
			if($BatallasActivas[$i]->getRonda()!="Exhibición")
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
			else
			{
				$PersonajesContados = new Exhibicion();
				$PersonajesContados->setIdBatalla($BatallasActivas[$i]->getId());
				$PersonajesContados=$PersonajesContados->read(true,1,array("IdBatalla"));
				for($j=0;$j<count($PersonajesContados);$j++)
				{
					$ConVoto = new Voto();
					$ConVoto->setIdBatalla($BatallasActivas[$i]->getId());
					$ConVoto->setIdPersonaje($PersonajesContados[$j]->getIdPersonaje());
					$ConVoto = $ConVoto->read(true,2,array("IdBatalla","AND","IdPersonaje"));
					$nuevaPelea = new Pelea();
					$nuevaPelea->setIdPersonaje($PersonajesContados[$j]->getIdPersonaje());
					$nuevaPelea->setIdBatalla($BatallasActivas[$i]->getId());
					$nuevaPelea->setVotos(count($ConVoto));
					$nuevaPelea->save();
				}
				$BatallasActivas[$i]->setActiva(1);
				$BatallasActivas[$i]->update(1,array("Activa"),1,array("Id"));

			}
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
}
?>
