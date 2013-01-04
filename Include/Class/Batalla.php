<?php
require_once "BatallaBD.php";
class Batalla extends BatallaBD
{
	function Batalla($Id="",$Fecha="",$Ronda="",$Grupo="",$Torneo="",$Activa="")
	{
		$this->Id = $Id;
		$this->Fecha = $Fecha;
		$this->Ronda = $Ronda;
		$this->Grupo = $Grupo;
		$this->Torneo = $Torneo;
		$this->Activa = $Activa;
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
	function setRonda($Ronda)
	{
		$this->Ronda=$Ronda;
	}
	function getRonda()
	{
		return $this->Ronda;
	}
	function setGrupo($Grupo)
	{
		$this->Grupo=$Grupo;
	}
	function getGrupo()
	{
		return $this->Grupo;
	}
	function setTorneo($Torneo)
	{
		$this->Torneo=$Torneo;
	}
	function getTorneo()
	{
		return $this->Torneo;
	}
	function setActiva($Activa)
	{
		$this->Activa=$Activa;
	}
	function getActiva()
	{
		return $this->Activa;
	}
}
?>
