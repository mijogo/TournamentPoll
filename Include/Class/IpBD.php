<?php
require_once "DataBase.php";
class ipBD extends DataBase
{
	function ipBD(){}
	
	function save()
	{		$sql = "INSERT INTO ip (Id,Fecha,IP,Tiempo,Usada,OptionPoll,CodePass,MasterIP,MasterCode,Info) VALUES 
		(
		'".$this->Id."',
		'".$this->Fecha."',
		'".$this->IP."',
		'".$this->Tiempo."',
		'".$this->Usada."',
		'".$this->OptionPoll."',
		'".$this->CodePass."',
		'".$this->MasterIP."',
		'".$this->MasterCode."',
		'".$this->Info."')";
		return $this->insert($sql);
	}

	function read($multi=true , $cantConsulta = 0 , $Consulta = "" , $cantOrden = 0 , $Orden = "",$fecha="",$restriccion=false)
	{
		$sql="SELECT * FROM ip ";
		if($cantConsulta != 0)
		{
			$sql .= "WHERE ";
			for($i=0;$i<$cantConsulta;$i++)
			{
				$sql .= $Consulta[$i*2]." = '".$this->$Consulta[$i*2]."' ";
				if($i != $cantConsulta-1)
					$sql .= $Consulta[$i*2+1]." ";
			}
		}
		
		if($cantOrden != 0)
		{
			$sql .= "ORDER BY ";
			for($i=0;$i<$cantOrden;$i++)
			{
				$sql .= $Orden [$i*2]." ".$Orden [$i*2+1]." ";
				if($i != $cantOrden-1)
					$sql .= ",";
			}
		}
		if($fecha!="")
			if($cantConsulta==0)
				$sql = "SELECT * FROM ip WHERE Fecha < '".$fecha." 22:00:00' AND Fecha > '".$fecha." 00:00:00' ORDER BY Fecha ASC";
			else
				if($restriccion)
					$sql = "SELECT * FROM ip WHERE ".$Consulta[0]." = '".$this->$Consulta[0]."' AND Fecha < '".$fecha." 22:00:00' AND Fecha > '".$fecha." 00:00:00' AND Usada != 0 ORDER BY Fecha ASC";
				else
					$sql = "SELECT * FROM ip WHERE ".$Consulta[0]." = '".$this->$Consulta[0]."' AND Fecha < '".$fecha." 22:00:00' AND Fecha > '".$fecha." 00:00:00' ORDER BY Fecha ASC";						
		if($multi)
		{
			$result = $this->select($sql);
			$ips = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$ips[]=new ip($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $ips;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$ips= new ip($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $ips;
		}
	}
	
	function update($cantSet = 0 , $Set = "" , $cantConsulta = 0 , $Consulta= "")
	{
		$sql="UPDATE ip ";
		if($cantSet != 0)
		{
			$sql .= "SET ";
			for($i=0;$i<$cantSet;$i++)
			{
				$sql .= $Set[$i]." = '".$this->$Set[$i]."' ";
				if($i != $cantSet-1)
					$sql .= ",";
			}
		}
		
		if($cantConsulta != 0)
		{
			$sql .= "WHERE ";
			for($i=0;$i<$cantConsulta;$i++)
			{
				$sql .= $Consulta[$i*2]." = '".$this->$Consulta[$i*2]."' ";
				if($i != $cantConsulta-1)
					$sql .= $Consulta[$i*2+1]." ";
			}
		}
		return $this->insert($sql);
	}
}
?>