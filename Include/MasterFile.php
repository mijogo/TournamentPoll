<?php
require_once "include.php";
class MasterClass
{
	function MasterClass()
	{}
	
	function llamarFuncion()
	{
		$logica = new LogicV();
		echo $logica->hacerLogica();
	}
}
?>