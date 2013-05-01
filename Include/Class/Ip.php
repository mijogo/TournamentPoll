<?php
require_once "IpBD.php";
class Ip extends IpBD
{
	function ip($Id="",$Fecha="",$IP="",$Tiempo="",$Usada="",$OptionPoll="",$CodePass="")
	{
		$this->Id = $Id;
		$this->Fecha = $Fecha;
		$this->IP = $IP;
		$this->Tiempo = $Tiempo;
		$this->Usada = $Usada;
		$this->OptionPoll = $OptionPoll;
		$this->CodePass = $CodePass;
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
		function setOptionPoll($OptionPoll)
	{
		$this->OptionPoll=$OptionPoll;
	}
	function getOptionPoll()
	{
		return $this->OptionPoll;
	}
	function setCodePass($CodePass)
	{
		$this->CodePass=$CodePass;
	}
	function getCodePass()
	{
		return $this->CodePass;
	}
}
?>
