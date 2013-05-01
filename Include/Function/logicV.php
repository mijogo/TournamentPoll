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
			if($hay!=0)
			{
				if($esteTorneo->getStatus() == 1)
				{	
					/*$text.="<h6>".fechaHoraActual("d/m/Y")."</h6>
					<h1>No hay nada disputandose</h1>";*/
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
					<h1>Periodo de Nominaciones</h1>";
					$personajesB = new Personaje();
					$personajesB->setInscripcion(1);
					$personajesB = $personajesB->read(true,1,array("Inscripcion"),2,array("Serie","ASC","Nombre","ASC"));
					$datosD[0][0] = "Nombre";
					$datosD[0][1] = "Serie";
					for($rf=0;$rf<count($personajesB);$rf++)
					{
						$datosD[$rf+1][0] = $personajesB[$rf]->getNombre();
						$datosD[$rf+1][1] = $personajesB[$rf]->getSerie();
					}
					$text.=div(table($datosD,"0-180"),"","fight");

				}

				if($esteTorneo->getStatus() == 2)
				{
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
					<h1>Periodo de Nominaciones</h1>";
					$personajesB = new Personaje();
					$personajesB->setInscripcion(1);
					$personajesB = $personajesB->read(true,1,array("Inscripcion"),2,array("Serie","ASC","Nombre","ASC"));
					$datosD[0][0] = "Nombre";
					$datosD[0][1] = "Serie";
					for($rf=0;$rf<count($personajesB);$rf++)
					{
						$datosD[$rf+1][0] = $personajesB[$rf]->getNombre();
						$datosD[$rf+1][1] = $personajesB[$rf]->getSerie();
					}
					$text.=div(table($datosD,"0-180"),"","fight");
				}
				if($esteTorneo->getStatus() == 3)
				{
					$cualesBatalla = new Batalla();
					$cualesBatalla->setActiva(0);
					$cualesBatalla = $cualesBatalla->read(true,1,array("Activa"));
					$cambio =false;
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>";
					$pruebaLogica = new LogicC();
					for($i=0;$i<count($cualesBatalla);$i++)
					{	
						$datosUtilizar = $pruebaLogica->batallaDatosAccion($cualesBatalla[$i]->getId());
						for($j=0;$j<count($datosUtilizar);$j++)
						{
							$PersonajeUtil = new Personaje();
							$PersonajeUtil->setId($datosUtilizar[$j]["Id"]);
							$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
							$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
							$queBonito[$j][0]=div($text2,"","elem");
							$text2=div($PersonajeUtil->getNombre(),"","Grandes");
							$queBonito[$j][1]=div($text2,"","elem");
							if($j==0||$Valor>0)
							{
								if($datosUtilizar[$j]["Votos"]!=0&&($j==0||$datosUtilizar[$j]["Votos"]==$Valor))
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandesR");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=$datosUtilizar[$j]["Votos"];
								}
								else
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=0;								
								}
							}
							else
							{
								$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
								$queBonito[$j][2]=div($text2,"","elem");
							}
						}
						$text1 = table($queBonito);
						$text .= "<h1>Ronda ".$cualesBatalla[$i]->getRonda()." Grupo ".$cualesBatalla[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$cualesBatalla[$i]->getId(),"","width: 450px; height: 200px;");
					}
				}
				if($esteTorneo->getStatus() == 4)
				{
					$cualesBatalla = new Batalla();
					$cualesBatalla->setActiva(0);
					$cualesBatalla = $cualesBatalla->read(true,1,array("Activa"));
					$cambio =false;
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>";
					$pruebaLogica = new LogicC();
					for($i=0;$i<count($cualesBatalla);$i++)
					{	
						$datosUtilizar = $pruebaLogica->batallaDatosAccion($cualesBatalla[$i]->getId());
						for($j=0;$j<count($datosUtilizar);$j++)
						{
							$PersonajeUtil = new Personaje();
							$PersonajeUtil->setId($datosUtilizar[$j]["Id"]);
							$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
							$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
							$queBonito[$j][0]=div($text2,"","elem");
							$text2=div($PersonajeUtil->getNombre()." (".$PersonajeUtil->getSerie().")","","Grandes");
							$queBonito[$j][1]=div($text2,"","elem");
							if($j==0||$Valor>0)
							{
								if($datosUtilizar[$j]["Votos"]!=0&&($j==0||$datosUtilizar[$j]["Votos"]==$Valor))
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandesR");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=$datosUtilizar[$j]["Votos"];
								}
								else
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=0;								
								}
							}
							else
							{
								$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
								$queBonito[$j][2]=div($text2,"","elem");
							}
						}
						$text1 = table($queBonito,"0-80;1-300");
						$text .= "<h1>Ronda ".$cualesBatalla[$i]->getRonda()." Grupo ".$cualesBatalla[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$cualesBatalla[$i]->getId(),"","width: 450px; height: 200px;");
					}
					
				}
			}
			else
			{
				$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
				<h1>El torneo ha acabado</h1>";
			}
			
		}
		if($_GET['id']==3)
		{
			$file = fopen("Include/Function/reglas.html", "r") or exit("Unable to open file!");
			//Output a line of the file until the end is reached
			$text="";
			while(!feof($file))
			{
				$text .= fgets($file);
			}
			$text = div($text,"","fight");
			fclose($file);
		}
		if($_GET['id']==4)
		{
			$text .= div(img("images/calendariomsat.png"),"","fight");
		}
		if($_GET['id']==5)
		{
			$buscarTorneo = new Torneo();
			$buscarTorneo = $buscarTorneo->read();
			$hay = 0;
			for($i=0;$i<count($buscarTorneo);$i++)
			{
				if($buscarTorneo[$i]->getStatus()>0)
				{
					$esteTorneo = $buscarTorneo[$i];
					$hay++;
				}
			}
			if($hay>0)
			{
				if($esteTorneo->getStatus() == 1)
				{	
					$text.="No hay acciones disponibles";
				}
	
				if($esteTorneo->getStatus() == 2)
				{
					$buscarIp = new Ip();
					$buscarIp->setIp(getRealIP());
					$buscarIp=$buscarIp->read(true,1,array("IP"));
					$esta = false;
					for($i=0;$i<count($buscarIp);$i++)
					{
						$fechaB = explode(" ",$buscarIp[$i]->getFecha());
						$fechaA = fechaHoraActual("Y-m-d");
						if($fechaB[0] == $fechaA)
						{
							$esta = true;
							$ipUsar = $buscarIp[$i]->getIp();
						}
					}
					if(!$esta)
					{
						$text.=Nominaciones(configuracion("Config","NNominaciones"));
					}
					else
					{
						$text.= "<h3>Mañana puedes seguir nominando</h3>";
					}
				}
				if($esteTorneo->getStatus() == 3)
				{
					$BatallasActivas = new Batalla();
					$BatallasActivas->setActiva(0);
					$consulta = array("Activa");
					$BatallasActivas = $BatallasActivas->read(true,1,$consulta);
					$text .= "<h6>".fechaHoraActual("Y-m-d")."</h6>";
					$text1 = "";
					$idBataAr=array();
					
					$buscarIp = new Ip();
					$buscarIp->setIp(getRealIP());
					$buscarIp=$buscarIp->read(true,1,array("IP"));
					$esta = false;
					for($i=0;$i<count($buscarIp);$i++)
					{
						$fechaB = explode(" ",$buscarIp[$i]->getFecha());
						$fechaA = fechaHoraActual("Y-m-d");
						if($fechaB[0] == $fechaA)
						{
							$esta = true;
							$ipUsar = $buscarIp[$i]->getIp();
						}
					}
					
					if(!$esta)
					{
						$buscarIp = new Ip();
						$buscarIp->setCodePass($_COOKIE['CodePassVote']);
						$buscarIp=$buscarIp->read(true,1,array("CodePass"));
						for($i=0;$i<count($buscarIp);$i++)
						{
							$fechaB = explode(" ",$buscarIp[$i]->getFecha());
							$fechaA = fechaHoraActual("Y-m-d");
							if($fechaB[0] == $fechaA)
							{
								$esta = true;
								$ipUsar = $buscarIp[$i]->getIp();
							}
						}
					}

					if(!$esta)
					{
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
								$datos[0][0] =  img($buscarPersonajes[$j]->getImagen(),"","","","bordes");
								$datos[0][1] =  $buscarPersonajes[$j]->getNombre();
								$text1 .= botonVoto($BatallasActivas[$i]->getId(),$buscarPersonajes[$j]->getId(),$secuencia,table($datos,"0-80"));							
							}
							$idBataAr[] = $BatallasActivas[$i]->getId();
						}
						$text .=  div($text1.formVoto("?id=5&action=2&trato=2",$idBataAr,configuracion($BatallasActivas[0]->getRonda(),"LimiteVoto")),"","fight");
						if(configuracion("Exhibición","LimiteVoto")==1)
							$text .= "<h6>*Solo puedes votar por un personaje</h6>";
						else
							$text .= "<h6>*puedes votar por ".configuracion("Exhibición","LimiteVoto")." personajes</h6>";
						$text .= "<h6>*Haz click sobre los personajes que deseas votar y presiona el botón votar </h6>";
						$text .= "<h6>*Al hacer click sobre un personaje, este cambiara a color azul, lo que significa que lo haz seleccionado, cuando los demás se vuelven de color rojo, significa que no puedes votar por mas personajes, para cambiar el voto solo debes hacer click sobre uno seleccionado y se volverá naranjo </h6>";
					}
					else
					{
						for($i=0;$i<count($BatallasActivas);$i++)
						{
							$text1 .= "<h3>Ronda ".$BatallasActivas[$i]->getRonda()." Grupo ".$BatallasActivas[$i]->getGrupo()."<br></h3>";
							$VotoS = new Voto();
							$VotoS->setIP($ipUsar);
							$VotoS->setIdBatalla($BatallasActivas[$i]->getId());
							
							$VotoS = $VotoS->read(true,2,array("IP","AND","IdBatalla"));
							
							for($j=0;$j<count($VotoS);$j++)
							{
								$personajeUsar = new Personaje();
								$personajeUsar->setId($VotoS[$j]->getIdPersonaje());
								$personajeUsar = $personajeUsar->read(false,1,array("Id"));
								$datos[0][0] =  img($personajeUsar->getImagen(),"","","","bordes");
								$datos[0][1] =  $personajeUsar->getNombre()."<br>".$personajeUsar->getSerie();
								$text1 .= botonAct(table($datos,"0-80"));							
							}
							$text .=  div($text1,"","fight");
							$text .= "<h6>*Votos emitidos </h6>";
						}
					}		
				}
				if($esteTorneo->getStatus() == 4)
				{
					$BatallasActivas = new Batalla();
					$BatallasActivas->setActiva(0);
					$consulta = array("Activa");
					$BatallasActivas = $BatallasActivas->read(true,1,$consulta);
					$text .= "<h6>".fechaHoraActual("Y-m-d")."</h6>";
					$text1 = "";
					$idBataAr=array();
					
					
					$buscarIp = new Ip();
					$buscarIp->setIp(getRealIP());
					$buscarIp=$buscarIp->read(true,1,array("IP"));
					$esta = false;
					for($i=0;$i<count($buscarIp);$i++)
					{
						$fechaB = explode(" ",$buscarIp[$i]->getFecha());
						$fechaA = fechaHoraActual("Y-m-d");
						if($fechaB[0] == $fechaA)
						{
							$esta = true;
							$ipUsar = $buscarIp[$i]->getIp();
						}
					}
					
					if(!$esta)
					{
						$buscarIp = new Ip();
						$buscarIp->setCodePass($_COOKIE['CodePassVote']);
						$buscarIp=$buscarIp->read(true,1,array("CodePass"));
						for($i=0;$i<count($buscarIp);$i++)
						{
							$fechaB = explode(" ",$buscarIp[$i]->getFecha());
							$fechaA = fechaHoraActual("Y-m-d");
							if($fechaB[0] == $fechaA)
							{
								$esta = true;
								$ipUsar = $buscarIp[$i]->getIp();
							}
						}
					}

					if(!$esta)
					{
						for($i=0;$i<count($BatallasActivas);$i++)
						{
							$text1 .= "<h3>Ronda ".$BatallasActivas[$i]->getRonda()." Grupo ".$BatallasActivas[$i]->getGrupo()."<br></h3>";
							$buscarPersonajes = new Exhibicion();
							$buscarPersonajes->setIdBatalla($BatallasActivas[$i]->getId());
							$buscarPersonajes = $buscarPersonajes->read(true,1,array("IdBatalla"));
							$secuencia="";
							for($j=0;$j<count($buscarPersonajes);$j++)
							{
								$secuencia .= $buscarPersonajes[$j]->getIdPersonaje();
								if($j+1!=count($buscarPersonajes))
									$secuencia .= "-";
							}
						
							for($j=0;$j<count($buscarPersonajes);$j++)
							{
								$personajeUsar = new Personaje();
								$personajeUsar->setId($buscarPersonajes[$j]->getIdPersonaje());
								$personajeUsar = $personajeUsar->read(false,1,array("Id"));
								$datos[0][0] =  img($personajeUsar->getImagen(),"","","","bordes");
								$datos[0][1] =  $personajeUsar->getNombre()."<br>".$personajeUsar->getSerie();
								$text1 .= botonVoto($BatallasActivas[$i]->getId(),$personajeUsar->getId(),$secuencia,table($datos,"0-80"));							
							}
							$idBataAr[] = $BatallasActivas[$i]->getId();
						}
						$text .=  div($text1.formVoto("?id=5&action=2&trato=2",$idBataAr,configuracion($BatallasActivas[0]->getRonda(),"LimiteVoto")),"","fight");				
						if(configuracion("Exhibición","LimiteVoto")==1)
							$text .= "<h6>*Solo puedes votar por un personaje</h6>";
						else
							$text .= "<h6>*puedes votar por ".configuracion("Exhibición","LimiteVoto")." personajes</h6>";
						$text .= "<h6>*Haz click sobre los personajes que deseas votar y presiona el botón votar </h6>";
						$text .= "<h6>*Al hacer click sobre un personaje, este cambiara a color azul, lo que significa que lo haz seleccionado, cuando los demás se vuelven de color rojo, significa que no puedes votar por mas personajes, para cambiar el voto solo debes hacer click sobre uno seleccionado y se volverá naranjo </h6>";
					}
					else
					{
						for($i=0;$i<count($BatallasActivas);$i++)
						{
							$text1 .= "<h3>Ronda ".$BatallasActivas[$i]->getRonda()." Grupo ".$BatallasActivas[$i]->getGrupo()."<br></h3>";
							$VotoS = new Voto();
							$VotoS->setIP($ipUsar);
							$VotoS->setIdBatalla($BatallasActivas[$i]->getId());
							
							$VotoS = $VotoS->read(true,2,array("IP","AND","IdBatalla"));
							
							for($j=0;$j<count($VotoS);$j++)
							{
								$personajeUsar = new Personaje();
								$personajeUsar->setId($VotoS[$j]->getIdPersonaje());
								$personajeUsar = $personajeUsar->read(false,1,array("Id"));
								$datos[0][0] =  img($personajeUsar->getImagen(),"","","","bordes");
								$datos[0][1] =  $personajeUsar->getNombre()."<br>".$personajeUsar->getSerie();
								$text1 .= botonAct(table($datos,"0-80"));							
							}
							$text .=  div($text1,"","fight");
							$text .= "<h6>*Votos emitidos </h6>";
							/*$buscarPersonajes = new Exhibicion();
							$buscarPersonajes->setIdBatalla($BatallasActivas[$i]->getId());
							$buscarPersonajes = $buscarPersonajes->read(true,1,array("IdBatalla"));
							$secuencia="";
							for($j=0;$j<count($buscarPersonajes);$j++)
							{
								$secuencia .= $buscarPersonajes[$j]->getIdPersonaje();
								if($j+1!=count($buscarPersonajes))
									$secuencia .= "-";
							}
						
							for($j=0;$j<count($buscarPersonajes);$j++)
							{
								$personajeUsar = new Personaje();
								$personajeUsar->setId($buscarPersonajes[$j]->getIdPersonaje());
								$personajeUsar = $personajeUsar->read(false,1,array("Id"));
								$datos[0][0] =  img($personajeUsar->getImagen(),"","","","bordes");
								$datos[0][1] =  $personajeUsar->getNombre()."<br>".$personajeUsar->getSerie();
								$text1 .= botonVoto($BatallasActivas[$i]->getId(),$personajeUsar->getId(),$secuencia,table($datos,"0-80"));							
							}
							$idBataAr[] = $BatallasActivas[$i]->getId();*/
						}

					}
				}

			}
			else
				$text .="<h1>Aun no empieza el torneo</h1>";
		}
		if($_GET['id']==7)
		{
			if(!isset($_GET['trato']) || $_GET['trato']==1)
			{
				$text .="<h1>Seleccione los enfrentamientos</h1>";
				$text1="";
				$sigue=true;
				$text1.="<div class=\"botoncito\"><button class=\"button\" onclick=\"ingresar('Exhibición','0')\">Exhibición</button></div>";
				$instancia="Preliminares";
				while($sigue)
				{
					$text1.=botonEscoger($instancia,$instancia,configuracion($instancia,"NGrupos"));
					if(configuracion($instancia,"second"))
						$instancia = configuracion($instancia,"nextRonda2");
					else
						$instancia = configuracion($instancia,"nextRonda1");
					if($instancia=="Termino")
						$sigue = false;
				}
				$text .= div($text1,"cambiar","fight");
			}
			else if($_GET['trato']==2)
			{
				$utilLogic = new logicC();
				$text .="<h1>Enfrentamiento</h1>";
				$text1="";
				$batallasB = new Batalla();
				$batallasB->setRonda($_GET['instancia']);
				$instancia = $_GET['instancia'];
				$grupo = $_GET['grupo'];
				if($instancia=="Exhibición")
					$batallasB = $batallasB->read(true,1,array("Ronda"),1,array("Fecha","ASC"));
				else
					$batallasB = $batallasB->read(true,1,array("Ronda"));

				for($i=0;$i<count($batallasB);$i++)
				{
					if($instancia=="Ronda-1"||$instancia=="Ronda-2"||$instancia=="Ronda-3"||$instancia=="Ronda-4"||$instancia=="Ronda-5")
					{
						if(substr($batallasB[$i]->getGrupo(),0,1)==$grupo)
						{
							$text1 = "";
							$text1 .=" Fecha ".$batallasB[$i]->getFecha()."</h6>";
							if($batallasB[$i]->getActiva()==1)
							{
								$datosNec = $utilLogic->batallaDatosPasada($batallasB[$i]->getId());
								for($j=0;$j<count($datosNec);$j++)
								{
									$queBonito="";
									$PersonajeUtil = new Personaje();
									$PersonajeUtil->setId($datosNec[$j]["Id"]);
									$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
									$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
									$queBonito[$j][0]=div($text2,"","elem");
									$text2=div($PersonajeUtil->getNombre(),"","Grandes");
									$queBonito[$j][1]=div($text2,"","elem");
									if($j==0||$Valor>0)
									{
										if($datosUtilizar[$j]["Votos"]!=0&&($j==0||$datosUtilizar[$j]["Votos"]==$Valor))
										{
											$text2=div($datosNec[$j]["Votos"],"","masGrandesR");
											$queBonito[$j][2]=div($text2,"","elem");
											$Valor=$datosUtilizar[$j]["Votos"];
										}
										else
										{
											$text2=div($datosNec[$j]["Votos"],"","masGrandes");
											$queBonito[$j][2]=div($text2,"","elem");
											$Valor=0;								
										}
									}
									else
									{
										$text2=div($datosNec[$j]["Votos"],"","masGrandes");
										$queBonito[$j][2]=div($text2,"","elem");
									}
								}
								$text1 .= table($queBonito);
								$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$batallasB[$i]->getId(),"","width: 450px; height: 200px;");
							}
							else
							{
								$personajesB = new Personaje();
								$personajesB->setRonda($batallasB[$i]->getRonda());
								$personajesB->setGrupo($batallasB[$i]->getGrupo());
								$personajesB = $personajesB->read(true,2,array("Ronda","AND","Grupo"));
								$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()." (".$batallasB[$i]->getFecha().")</h1>";
								if(count($personajesB)!=0)
								{
									$queBonito="";
									for($j=0;$j<count($personajesB);$j++)
									{
										$text2=img($personajesB[$j]->getImagen(),"","","","bordes");
										$queBonito[$j][0]=div($text2,"","elem");
										$text2=div($personajesB[$j]->getNombre()."(".$personajesB[$j]->getSerie().")","","Grandes");
										$queBonito[$j][1]=div($text2,"","elem");
									}
									$text .= table($queBonito);
								}
								else
								{
									$text .= "<h5>No hay participantes en este match</h5>";
								}
							}
						}
					}
					elseif($instancia=="Exhibición")
					{
						$text1 = "";
						$text1 .=" Fecha ".$batallasB[$i]->getFecha()."</h6>";
						if($batallasB[$i]->getActiva()==1)
						{
							$queBonito="";
							$datosNec = $utilLogic->batallaDatosPasada($batallasB[$i]->getId());
							for($j=0;$j<count($datosNec);$j++)
							{
								$PersonajeUtil = new Personaje();
								$PersonajeUtil->setId($datosNec[$j]["Id"]);
								$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
								$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
								$queBonito[$j][0]=div($text2,"","elem");
								$text2=div($PersonajeUtil->getNombre()."<br>".$PersonajeUtil->getSerie(),"","Grandes");
								$queBonito[$j][1]=div($text2,"","elem");
								if($j==0||$Valor>0)
								{
									if($datosNec[$j]["Votos"]!=0&&($j==0||$datosNec[$j]["Votos"]==$Valor))
									{
										$text2=div($datosNec[$j]["Votos"],"","masGrandesR");
										$queBonito[$j][2]=div($text2,"","elem");
										$Valor=$datosNec[$j]["Votos"];
									}
									else
									{
										$text2=div($datosNec[$j]["Votos"],"","masGrandes");
										$queBonito[$j][2]=div($text2,"","elem");
										$Valor=0;								
									}
								}
								else
								{
									$text2=div($datosNec[$j]["Votos"],"","masGrandes");
									$queBonito[$j][2]=div($text2,"","elem");
								}
							}
							$text1 .= table($queBonito,"0-80;1-300");
							$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$batallasB[$i]->getId(),"","width: 450px; height: 200px;");
						}
						else
						{
							$queBonito="";
							$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()." (".$batallasB[$i]->getFecha().")</h1>";
							$exhibicionN = new Exhibicion();
							$exhibicionN->setIdBatalla($batallasB[$i]->getid());
							$exhibicionN=$exhibicionN->read(true,1,array("IdBatalla"));
							$personajesB = array();
							for($gt=0;$gt<count($exhibicionN);$gt++)
							{
								$perd = new Personaje();
								$perd->setid($exhibicionN[$gt]->getIdPersonaje());
								$perd = $perd->read(false,1,array("Id"));
								$personajesB[] = $perd;
							}
							
							if(count($personajesB)!=0)
							{
								for($j=0;$j<count($personajesB);$j++)
								{
									$text2=img($personajesB[$j]->getImagen(),"","","","bordes");
									$queBonito[$j][0]=div($text2,"","elem");
									$text2=div($personajesB[$j]->getNombre()."(".$personajesB[$j]->getSerie().")","","Grandes");
									$queBonito[$j][1]=div($text2,"","elem");
								}
								$text .= div(table($queBonito),"","fight");
							}
							else
							{
								$text .= "<h5>No hay participantes en este match</h5>";
							}
						}
					}
					else
					{
						if($batallasB[$i]->getGrupo()==$grupo)
						{
							$text1 = "";
							$text1 .=" Fecha ".$batallasB[$i]->getFecha()."</h6>";
							if($batallasB[$i]->getActiva()==1)
							{
								$datosNec = $utilLogic->batallaDatosPasada($batallasB[$i]->getId());
								for($j=0;$j<count($datosNec);$j++)
								{
									$PersonajeUtil = new Personaje();
									$PersonajeUtil->setId($datosNec[$j]["Id"]);
									$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
									$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
									$queBonito[$j][0]=div($text2,"","elem");
									$text2=div($PersonajeUtil->getNombre(),"","Grandes");
									$queBonito[$j][1]=div($text2,"","elem");
									if($j==0||$Valor>0)
									{
										if($datosNec[$j]["Votos"]!=0&&($j==0||$datosNec[$j]["Votos"]==$Valor))
										{
											$text2=div($datosNec[$j]["Votos"],"","masGrandesR");
											$queBonito[$j][2]=div($text2,"","elem");
											$Valor=$datosNec[$j]["Votos"];
										}
										else
										{
											$text2=div($datosNec[$j]["Votos"],"","masGrandes");
											$queBonito[$j][2]=div($text2,"","elem");
											$Valor=0;								
										}
									}
									else
									{
										$text2=div($datosNec[$j]["Votos"],"","masGrandes");
										$queBonito[$j][2]=div($text2,"","elem");
									}
								}
								$text1 .= table($queBonito);
								$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$batallasB[$i]->getId(),"","width: 450px; height: 200px;");
							}
							else
							{
								$personajesB = new Personaje();
								$personajesB->setRonda($batallasB[$i]->getRonda());
								$personajesB->setGrupo($batallasB[$i]->getGrupo());
								$personajesB = $personajesB->read(true,2,array("Ronda","AND","Grupo"));
								$text .= "<h1>Ronda ".$batallasB[$i]->getRonda()." Grupo ".$batallasB[$i]->getGrupo()." (".$batallasB[$i]->getFecha().")</h1>";
								if(count($personajesB)!=0)
								{
									for($j=0;$j<count($personajesB);$j++)
									{
										$text2=img($personajesB[$j]->getImagen(),"","","","bordes");
										$queBonito[$j][0]=div($text2,"","elem");
										$text2=div($personajesB[$j]->getNombre()."(".$personajesB[$j]->getSerie().")","","Grandes");
										$queBonito[$j][1]=div($text2,"","elem");
									}
									$text .= table($queBonito);
								}
								else
								{
									$text .= "<h5>No hay participantes en este match</h5>";
								}
							}
						}
					}
				}
				$text = div($text,"","fight");
			}

		}
		/*
		for($j=0;$j<count($datosUtilizar);$j++)
						{
							$PersonajeUtil = new Personaje();
							$PersonajeUtil->setId($datosUtilizar[$j]["Id"]);
							$PersonajeUtil = $PersonajeUtil->read(false,1,array("Id"));
							$text2=img($PersonajeUtil->getImagen(),"","","","bordes");
							$queBonito[$j][0]=div($text2,"","elem");
							$text2=div($PersonajeUtil->getNombre(),"","Grandes");
							$queBonito[$j][1]=div($text2,"","elem");
							if($j==0||$Valor>0)
							{
								if($datosUtilizar[$j]["Votos"]!=0&&($j==0||$datosUtilizar[$j]["Votos"]==$Valor))
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandesR");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=$datosUtilizar[$j]["Votos"];
								}
								else
								{
									$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
									$queBonito[$j][2]=div($text2,"","elem");
									$Valor=0;								
								}
							}
							else
							{
								$text2=div($datosUtilizar[$j]["Votos"],"","masGrandes");
								$queBonito[$j][2]=div($text2,"","elem");
							}
						}
						$text1 = table($queBonito);
						$text .= "<h1>Ronda ".$cualesBatalla[$i]->getRonda()." Grupo ".$cualesBatalla[$i]->getGrupo()."</h1>".div($text1,"","fight").div("","graf".$cualesBatalla[$i]->getId(),"","width: 450px; height: 200px;");

		*/
		/*
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
		}	*/
		/*if($_GET['id']==10)
		{
			$text=div("","grafV1","","width: 900px; height: 500px;");
			$text.=div("","grafV2","","width: 900px; height: 500px;");
			$text.=div("","grafV3","","width: 900px; height: 500px;");

		}*/
		if($_GET['id']==11)
		{
			$text.="<h1>Partner</h1>";
			$text1="<p>Forma parte de la red de sitios de Miss Anime Tournament, apóyanos en esta gran labor de crear el gran torneo moe hispano, para esto solo debes contactar al staff por su correo electrónico, missanimetournament@gmail.com y expresar tus ganas en ayudarnos con este proyecto.</p>";
			$text.=div($text1,"","fight");
		}

		return $text;
	}
}
?>