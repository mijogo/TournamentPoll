<?php
require_once "PeleaBD.php";
class Pelea extends PeleaBD
{
	function Pelea($IdPersonaje="",$IdBatalla="",$Votos="")
	{
		$this->IdPersonaje = $IdPersonaje;
		$this->IdBatalla = $IdBatalla;
		$this->Votos = $Votos;
	}
	function setIdPersonaje($IdPersonaje)
	{
		$this->IdPersonaje=$IdPersonaje;
	}
	function getIdPersonaje()
	{
		return $this->IdPersonaje;
	}
	function setIdBatalla($IdBatalla)
	{
		$this->IdBatalla=$IdBatalla;
	}
	function getIdBatalla()
	{
		return $this->IdBatalla;
	}
	function setVotos($Votos)
	{
		$this->Votos=$Votos;
	}
	function getVotos()
	{
		return $this->Votos;
	}
}
?>
