<?php
define("AUTHPASS","Crear una auth pass");
define("SERVER","el server sql");
define("USER","usuario sql");
define("PASS","pass sql");
define("MYDB","nombre de la DB");

function configuracion($instancia,$parte)
{//NGrupo, cantidad de grupos & second , tiene segunda & clas1 y clas2 & nextRonda1 & grupoFijo & NBatalla
	$text = "";
	if($parte=="second")
		$text = false;
	if($parte == "LimiteVoto")
		$text = 1;
		
	if($instancia == "Config")
	{
		//cantidad en minutos de la duracion del match
		if($parte == "Duracion Batalla")
			$text = 1320;
		//el tiempo extra que toma sacar los resultados en minutos
		if($parte == "Extra conteo")
			$text = 10;
		//NÂ° Nominaciones
		if($parte == "NNominaciones")
			$text = 12;
		//Intervalo entre medicion y medicion en minutos
		if($parte == "Intervalo")
			$text = 20;
		//marca la hora de inicio de los match
		if($parte == "Hora Inicio")
			$text = "00:00:00";
		//duracion del contador durante un match
		if($parte == "Duracion Live")
			$text = 1200;
		//duracion del contador durante un match
		if($parte == "Max Miembros Grafo")
			$text = 10;
	}
	if($instancia == "Preliminares")
	{
		if($parte == "NGrupos")
			$text = 16;
		if($parte == "second")
			$text = true;
		if($parte == "clas1")
			$text = 12;
		if($parte == "clas2")
			$text = 36;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "nextRonda2")
			$text = "Repechaje";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "LimiteVoto")
			$text = 10;
	}
	else if($instancia == "Repechaje")
	{
		if($parte == "NGrupos")
			$text = 6;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 16;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "LimiteVoto")
			$text = 12;

	}
	else if($instancia == "Ronda-1")
	{
		if($parte == "NGrupos")
			$text = 8;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-2";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "NBatalla")
			$text = 12;
	}

	else if($instancia == "Ronda-2")
	{
		if($parte == "NGrupos")
			$text = 8;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-3";
		if($parte == "grupoFijo")
			$text = true;
		if($parte == "NBatalla")
			$text = 4;
	}
	
	else if($instancia == "Ronda-3")
	{
		if($parte == "NGrupos")
			$text = 8;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-4";
		if($parte == "grupoFijo")
			$text = true;
		if($parte == "NBatalla")
			$text = 2;
	}

	else if($instancia == "Ronda-4")
	{
		if($parte == "NGrupos")
			$text = 8;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Final-1";
		if($parte == "grupoFijo")
			$text = true;
		if($parte == "NBatalla")
			$text = 1;
	}

	else if($instancia == "Final-1")
	{
		if($parte == "NGrupos")
			$text = 4;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Final-2";
		if($parte == "grupoFijo")
			$text = false;
	}
	
	else if($instancia == "Final-2")
	{
		if($parte == "NGrupos")
			$text = 2;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Final-3";
		if($parte == "grupoFijo")
			$text = true;
	}
	
	else if($instancia == "Final-3")
	{
		if($parte == "NGrupos")
			$text = 1;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Termino";
		if($parte == "grupoFijo")
			$text = true;
	}

	else if($instancia == "Grupo")
	{
		if($parte == "A")
			$text = 0;
		if($parte == "B")
			$text = 1;
		if($parte == "C")
			$text = 2;
		if($parte == "D")
			$text = 3;
		if($parte == "E")
			$text = 4;
		if($parte == "F")
			$text = 5;
		if($parte == "G")
			$text = 6;
		if($parte == "H")
			$text = 7;
	}
	else if($instancia == "Rev Grupo")
	{
		if($parte == 0)
			$text= "A";
		if($parte == 1)
			$text= "B";
		if($parte == 2)
			$text= "C";
		if($parte == 3)
			$text= "D";
		if($parte == 4)
			$text= "E";
		if($parte == 5)
			$text= "F";
		if($parte == 6)
			$text= "G";
		if($parte == 7)
			$text= "H";
	}

	return $text;
}
?>