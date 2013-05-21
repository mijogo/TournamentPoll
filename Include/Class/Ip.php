<?php
require_once "IpBD.php";
class ip extends ipBD
{
	function ip($Id="",$Fecha="",$IP="",$Tiempo="",$Usada="",$OptionPoll="",$CodePass="",$MasterIP="",$MasterCode="",$Info="")
	{
		$this->Id = $Id;
		$this->Fecha = $Fecha;
		$this->IP = $IP;
		$this->Tiempo = $Tiempo;
		$this->Usada = $Usada;//0:Sin usar;1:usada para votar;2:fue usada pero no fue agregada;3:Agrega una ip a un cierto Codepass;
		//4: lo mismo que el 2 pero con ip;5:Agrega un nuevo equipo Codepass;6:despues de votar, se agregan todas aca;
		$this->OptionPoll = $OptionPoll;
		$this->CodePass = $CodePass;
		$this->MasterIP = $MasterIP;
		$this->MasterCode = $MasterCode;
		$this->Info = $Info;
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
	function setMasterIP($MasterIP)
	{
		$this->MasterIP=$MasterIP;
	}
	function getMasterIP()
	{
		return $this->MasterIP;
	}
	function setMasterCode($MasterCode)
	{
		$this->MasterCode=$MasterCode;
	}
	function getMasterCode()
	{
		return $this->MasterCode;
	}
	function setInfo($Info)
	{
		$this->Info=$Info;
	}
	function getInfo()
	{
		return $this->Info;
	}
}
?>
