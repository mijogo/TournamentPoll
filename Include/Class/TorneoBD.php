<?php
require_once "DataBase.php";
class TorneoBD extends DataBase
{
	function TorneoBD(){}
	
	function save()
	{		$sql = "INSERT INTO Torneo (Id,Ano,Version,Nombre,Status) VALUES 
		(
		'".$this->Id."',
		'".$this->Ano."',
		'".$this->Version."',
		'".$this->Nombre."',
		'".$this->Status."')";
		return $this->insert($sql);
	}

	function read($multi=true , $cantConsulta = 0 , $Consulta = "" , $cantOrden = 0 , $Orden = "")
	{
		$sql="SELECT * FROM Torneo ";
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
			$Torneos = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$Torneos[]=new Torneo($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $Torneos;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$Torneos= new Torneo($row[$i++],$row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $Torneos;
		}
	}
	
	function update($cantSet = 0 , $Set = "" , $cantConsulta = 0 , $Consulta= "")
	{
		$sql="UPDATE Torneo ";
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
