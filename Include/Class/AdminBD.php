<?php
require_once "DataBase.php";
class AdminBD extends DataBase
{
	function AdminBD(){}
	
	function save()
	{		$sql = "INSERT INTO admin (Id,User,Pass,Mail,Authpass,Nivel) VALUES 
		(
		'".$this->Id."',
		'".$this->User."',
		'".$this->Pass."',
		'".$this->Mail."',
		'".$this->Authpass."',
		'".$this->Nivel."')";
		return $this->insert($sql);
	}

	function read($multi=true , $cantConsulta = 0 , $Consulta = "" , $cantOrden = 0 , $Orden = "")
	{
		$sql="SELECT * FROM admin ";
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
			$Admins = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$Admins[]=new Admin($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $Admins;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$Admins= new Admin($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $Admins;
		}
	}
	
	function update($cantSet = 0 , $Set = "" , $cantConsulta = 0 , $Consulta= "")
	{
		$sql="UPDATE admin ";
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
