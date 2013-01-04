<?php
require_once "ScheduleBD.php";
class Schedule extends ScheduleBD
{
	function Schedule($Id="",$Accion="",$Fecha="",$Hecho="",$Target="")
	{
		$this->Id = $Id;
		$this->Accion = $Accion;
		$this->Fecha = $Fecha;
		$this->Hecho = $Hecho;
		$this->Target = $Target;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setAccion($Accion)
	{
		$this->Accion=$Accion;
	}
	function getAccion()
	{
		return $this->Accion;
	}
	function setFecha($Fecha)
	{
		$this->Fecha=$Fecha;
	}
	function getFecha()
	{
		return $this->Fecha;
	}
	function setHecho($Hecho)
	{
		$this->Hecho=$Hecho;
	}
	function getHecho()
	{
		return $this->Hecho;
	}
	function setTarget($Target)
	{
		$this->Target=$Target;
	}
	function getTarget()
	{
		return $this->Target;
	}
}
?>
