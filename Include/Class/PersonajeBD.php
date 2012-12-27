<?php
require_once "DataBase.php";
class PersonajeBD extends DataBase
{
	function PersonajeBD(){}
	
	function save()
	{
		$sql = "INSERT INTO Personaje (Nombre,Serie,Imagen) VALUES 
		(
		'".$this->Nombre."','".$this->Serie."','".$this->Imagen."'
		) ";
		return $this->insert($sql);
	}

	function read($multi=true , $cantConsulta = 0 , $Consultas = "" , $cantOrden = 0 , $Orden = "")
	{
		$sql="SELECT * FROM Personaje ";
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
				$sql .= $Consulta[$i*2]." ".$Consulta[$i*2+1]." ";
				if($i != $cantConsulta-1)
					$sql .= ",";
			}
		}
		
		if($multi)
		{
			$result = $this->select($sql);
			$Personajes = array();
			while($row = $this->fetch($result))
			{
				$i=0;
				$Personajes[]=new Personaje($row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			}
			$this->close();
			return $Personajes;
		}
		else
		{
			$result = $this->select($sql);
			$row = $this->fetch($result);
			$i=0;
			$Personajes = new Personaje($row[$i++],$row[$i++],$row[$i++],$row[$i++]);
			$this->close();
			return $Personajes;
		}
	}
	
	function update($cantSet = 0 , $Set = "" , $cantConsulta = 0 , $Consulta= "")
	{
		$sql="UPDATE Personaje ";
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
		
		if(!$cantConsulta != 0)
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