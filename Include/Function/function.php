<?php
function configuracion($instancia,$parte)
{//NGrupo, cantidad de grupos & second , tiene segunda & clas1 y clas2 & nextRonda1 & grupoFijo & NBatalla
	$text = "";
	if($parte=="second")
		$text = false;
	if($instancia == "Preeliminares")
	{
		if($parte == "NGrupos")
			$text = 3;
		if($parte == "second")
			$text = true;
		if($parte == "clas1")
			$text = 4;
		if($parte == "clas2")
			$text = 4;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "nextRonda2")
			$text = "Repechaje";
		if($parte == "grupoFijo")
			$text = false;
	}
	else if($instancia == "Repechaje")
	{
		if($parte == "NGrupos")
			$text = 3;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 4;
		if($parte == "nextRonda1")
			$text = "Ronda-1";
		if($parte == "grupoFijo")
			$text = false;
	}
	else if($instancia == "Ronda-1")
	{
		if($parte == "NGrupos")
			$text = 2;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Ronda-2";
		if($parte == "grupoFijo")
			$text = false;
		if($parte == "NBatalla")
			$text = 3;
	}
	else if($instancia == "Ronda-2")
	{
		if($parte == "NGrupos")
			$text = 2;
		if($parte == "second")
			$text = false;
		if($parte == "clas1")
			$text = 1;
		if($parte == "nextRonda1")
			$text = "Final";
		if($parte == "grupoFijo")
			$text = true;
		if($parte == "NBatalla")
			$text = 1;
	}
	else if($instancia == "Final")
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
			$tect = 0;
		if($parte == "B")
			$tect = 1;
		if($parte == "C")
			$tect = 2;
		if($parte == "D")
			$tect = 3;
		if($parte == "E")
			$tect = 4;
		if($parte == "F")
			$tect = 5;
		if($parte == "G")
			$tect = 6;
		if($parte == "H")
			$tect = 7;
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
function fechaHoraActual()
{
	return date('Y-m-d H:i:s');
}
function FechaMayor($fecha1,$fecha2)
{
	$corte1 = explode(" ",$fecha1);
	$Hora1 = explode(":",$corte1[1]);
	$Dia1 = explode("-",$corte1[0]);
	$corte2 = explode(" ",$fecha2);
	$Hora2 = explode(":",$corte2[1]);
	$Dia2 = explode("-",$corte2[0]);
	if($Hora1[0]==$Hora2[0]&&$Hora1[1]==$Hora2[1]&&$Hora1[2]==$Hora2[2]&&$Dia1[0]==$Dia2[0]&&$Dia1[1]==$Dia2[1]&&$Dia1[2]==$Dia2[2])
		return 0;
	
	if($Dia1[0]>$Dia2[0])
		return 1;
	else if($Dia1[0]<$Dia2[0])
		return -1;
	else if($Dia1[1]>$Dia2[1])
		return 1;
	else if($Dia1[1]<$Dia2[1])
		return -1;
	else if($Dia1[2]>$Dia2[2])
		return 1;
	else if($Dia1[2]<$Dia2[2])
		return -1;	
	else if($Hora1[0]>$Hora2[0])
		return 1;
	else if($Hora1[0]<$Hora2[0])
		return -1;
	else if($Hora1[1]>$Hora2[1])
		return 1;
	else if($Hora1[1]<$Hora2[1])
		return -1;
	else if($Hora1[2]>$Hora2[2])
		return 1;
	else if($Hora1[2]<$Hora2[2])
		return -1;	
}

function grafico($titulo="",$nombre="",$cantidad="",$titulos="",$datos="")
{
	$grafic = "";
	$grafic .= "    <script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
    <script type=\"text/javascript\">
      google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([";
        for($i=0;$i<count($titulos);$i++)
        {
        	if($i==0)
        		$grafic .= "[";
        	$grafic .= "'".$titulos[$i]."'";
        	if($i==$cantidad-1)
        		$grafic.="]";
        	$grafic.=",";
        }
        $grafic.="\n";
        for($j=0;$j<count($datos);$j++)
        {
        	for($i=0;$i<count($titulos);$i++)
       	 	{
        		if($i==0)
        			$grafic .= "[";
        		if($i==0)
        			$grafic .= "'".$datos[$j][$i]."'";
        		else
        			$grafic .= $datos[$j][$i];   			
        		if($i==$cantidad-1)
        			$grafic.="]";
        		if(!($i==$cantidad-1&&$j==count($datos)-1))
        			$grafic.=",";
        	}
        	$grafic .= "\n";
        }
        $grafic .= "]);

        var options = {
          title: '".$titulo."'
        };

        var chart = new google.visualization.LineChart(document.getElementById('".$nombre."'));
        chart.draw(data, options);
      }
    </script>
";
	return $grafic;
}

function GenerarSiguiente($actual,$Ronda)
{
	$actual = explode("-",$actual);
	$cantidad = configuracion(configuracion($actual,"nextRonda1"),"NBatalla")/configuracion($actual,"NBatalla");
	$actual[1]=$actual[1]/$cantidad;
	$actual[1]=$actual[1]+(1/$cantidad);
	$actual[1]=round($actual[1]);
	if($actual[1]<10)
	$actual[1] = "0".$actual[1];
	return $actual[0]."-".$actual[1];
}

function Redireccionar($url="")
{
	echo "<head>
<script languaje=\"JavaScript\">
location.href='".$url."';
</script>
</head>";
}

?>