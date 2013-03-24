<?php
define("AUTHPASS","sda7hbnc7hh33jf8syy");
define("SERVER","localhost");
define("USER","root");
define("PASS","");
define("MYDB","PollTournament");

function configuracion($instancia,$parte)
{//NGrupo, cantidad de grupos & second , tiene segunda & clas1 y clas2 & nextRonda1 & grupoFijo & NBatalla
	$text = "";
	if($parte=="second")
		$text = false;
		
	if($instancia == "Config")
	{
		//cantidad en minutos de la duracion del match
		if($parte == "Duracion Batalla")
			$text = 2760;
		//el tiempo extra que toma sacar los resultados en minutos
		if($parte == "Extra conteo")
			$text = 20;
		//NÂ° Nominaciones
		if($parte == "NNominaciones")
			$text = 5;
		//Intervalo entre medicion y medicion en minutos
		if($parte == "Intervalo")
			$text = 20;
		//marca la hora de inicio de los match
		if($parte == "Hora Inicio")
			$text = "1:00:00";
		//duracion del contador durante un match
		if($parte == "Duracion Live")
			$text = 2000;
		//duracion del contador durante un match
		if($parte == "Max Miembros Grafo")
			$text = 10;
	}
	if($instancia == "Preliminares")
	{
		if($parte == "NGrupos")
			$text = 6;
		if($parte == "second")
			$text = true;
		if($parte == "clas1")
			$text = 8;
		if($parte == "clas2")
			$text = 18;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "nextRonda2")
			$text = "Repechaje";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "LimiteVoto")
			$text = 8;
	}
	else if($instancia == "Repechaje")
	{
		if($parte == "NGrupos")
			$text = 3;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 8;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "grupoFijo")
			$text = false;
	}
	else if($instancia == "Ronda-1")
	{
		if($parte == "NGrupos")
			$text = 4;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-2";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "NBatalla")
			$text = 6;
	}

	else if($instancia == "Ronda-2")
	{
		if($parte == "NGrupos")
			$text = 4;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-3";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "NBatalla")
			$text = 2;
	}
	
	else if($instancia == "Ronda-3")
	{
		if($parte == "NGrupos")
			$text = 4;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Final-1";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "NBatalla")
			$text = 1;
	}

	else if($instancia == "Final-1")
	{
		if($parte == "NGrupos")
			$text = 2;
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
			$text = 1;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Termino";
		if($parte == "grupoFijo")
			$text = false;
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