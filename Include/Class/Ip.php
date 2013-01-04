<?php
require_once "IpBD.php";
class Ip extends IpBD
{
	function Ip($Id="",$Fecha="",$IP="",$Tiempo="",$Usada="")
	{
		$this->Id = $Id;
		$this->Fecha = $Fecha;
		$this->IP = $IP;
		$this->Tiempo = $Tiempo;
		$this->Usada = $Usada;
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
	function setIP($IP)
	{
		$this->IP=$IP;
	}
	function getIP()
	{
		return $this->IP;
	}
	function setTiempo($Tiempo)
	{
		$this->Tiempo=$Tiempo;
	}
	function getTiempo()
	{
		return $this->Tiempo;
	}
	function setUsada($Usada)
	{
		$this->Usada=$Usada;
	}
	function getUsada()
	{
		return $this->Usada;
	}
}
?>
