<?php
require_once "DataBase.php";
class MenuAdminBD extends DataBase
{
	function MenuAdminBD(){}
	
	function save()
	{		$sql = "INSERT INTO menuadmin (Id,IdDependencia,Titulo,Descripcion) VALUES 
		(
		'".$this->Id."',
		'".$this->IdDependencia."',
		'".$this->Titulo."',
		'".$this->Descripcion."')";
		return $this->insert($sql);
	}

	function read($multi=true , $cantConsulta = 0 , $Consulta = "" , $cantOrden = 0 , $Orden = "")
	{
		$sql="SELECT * FROM menuadmin ";
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
			$MenuAdmins = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$MenuAdmins[]=new MenuAdmin($row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $MenuAdmins;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$MenuAdmins= new MenuAdmin($row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $MenuAdmins;
		}
	}
	
	function update($cantSet = 0 , $Set = "" , $cantConsulta = 0 , $Consulta= "")
	{
		$sql="UPDATE menuadmin ";
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
