<?php
class LogicV
{
	function LogicV(){}
	
	function hacerLogica()
	{
		$estePersonaje = new Personaje();
		$estePersonaje->setNombre("Ana"); 		
		$estePersonaje->setSerie("Demas"); 
		$set=array();
		$set[]="Serie";
	 	$consulta=array();
	 	$consulta[]="Nombre";
		$estePersonaje = $estePersonaje->update(1,$set,1,$consulta);
	}
}
?>