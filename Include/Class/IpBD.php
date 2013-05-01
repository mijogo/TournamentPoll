<?php
require_once "DataBase.php";
class IpBD extends DataBase
{
	function IpBD(){}
	
	function save()
	{		$sql = "INSERT INTO ip (Id,Fecha,IP,Tiempo,Usada,OptionPoll,CodePass) VALUES 
		(
		'".$this->Id."',
		'".$this->Fecha."',
		'".$this->IP."',
		'".$this->Tiempo."',
		'".$this->Usada."',
		'".$this->OptionPoll."',
		'".$this->CodePass."')";
		return $this->insert($sql);
	}
	function read($multi=true , $cantConsulta = 0 , $Consulta = "" , $cantOrden = 0 , $Orden = "")
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
		if($multi)
		{
			$result = $this->select($sql);
			$Ips = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$Ips[]=new Ip($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $Ips;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$Ips= new Ip($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $Ips;
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
				if($i != $cantConsulta-1)
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