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
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
					<h1>No hay nada disputandose</h1>";
				}

				if($esteTorneo->getStatus() == 2)
				{
					$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
					<h1>Periodo de Nominaciones</h1>";
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
			}
			else
			{
				$text.="<h6>".fechaHoraActual("Y-m-d")."</h6>
				<h1>El torneo ha acabado</h1>";
			}
			
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
							$datos[0][0] =  img($buscarPersonajes[$j]->getImagen(),"","","","bordes");
							$datos[0][1] =  $buscarPersonajes[$j]->getNombre();
							$text1 .= botonVoto($BatallasActivas[$i]->getId(),$buscarPersonajes[$j]->getId(),$secuencia,table($datos,"0-80"));							
						}
						$idBataAr[] = $BatallasActivas[$i]->getId();
					}
					$text .=  div($text1.formVoto("?id=4&action=2&trato=2",$idBataAr,configuracion($BatallasActivas[0]->getRonda(),"LimiteVoto")),"","fight");			
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

		return $text;
	}
}
?>