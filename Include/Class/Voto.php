<?php
require_once "VotoBD.php";
class Voto extends VotoBD
{
	function Voto($Id="",$Fecha="",$IdBatalla="",$IdPersonaje="",$IP="")
	{
		$this->Id = $Id;
		$this->Fecha = $Fecha;
		$this->IdBatalla = $IdBatalla;
		$this->IdPersonaje = $IdPersonaje;
		$this->IP = $IP;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setFecha($Fecha)
	{
		$this->Fecha=$Fecha;
	}
	function getFecha()
	{
		return $this->Fecha;
	}
	function setIdBatalla($IdBatalla)
	{
		$this->IdBatalla=$IdBatalla;
	}
	function getIdBatalla()
	{
		return $this->IdBatalla;
	}
	function setIdPersonaje($IdPersonaje)
	{
		$this->IdPersonaje=$IdPersonaje;
	}
	function getIdPersonaje()
	{
		return $this->IdPersonaje;
	}
	function setIP($IP)
	{
		$this->IP=$IP;
	}
	function getIP()
	{
		return $this->IP;
	}
}

?>
