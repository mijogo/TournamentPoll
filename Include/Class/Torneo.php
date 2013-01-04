<?php
require_once "TorneoBD.php";
class Torneo extends TorneoBD
{
	function Torneo($Id="",$Ano="",$Version="",$Nombre="",$Status="")
	{
		$this->Id = $Id;
		$this->Ano = $Ano;
		$this->Version = $Version;
		$this->Nombre = $Nombre;
		$this->Status = $Status;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setAno($Ano)
	{
		$this->Ano=$Ano;
	}
	function getAno()
	{
		return $this->Ano;
	}
	function setVersion($Version)
	{
		$this->Version=$Version;
	}
	function getVersion()
	{
		return $this->Version;
	}
	function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	function getNombre()
	{
		return $this->Nombre;
	}
	function setStatus($Status)
	{
		$this->Status=$Status;
	}
	function getStatus()
	{
		return $this->Status;
	}
}
?>
