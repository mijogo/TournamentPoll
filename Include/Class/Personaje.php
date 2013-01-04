<?php
require_once "PersonajeBD.php";
class Personaje extends PersonajeBD
{
	function Personaje($Id="",$Nombre="",$Serie="",$Imagen="",$Inscripcion="",$Eliminada="",$Grupo="",$Ronda="")
	{
		$this->Id = $Id;
		$this->Nombre = $Nombre;
		$this->Serie = $Serie;
		$this->Imagen = $Imagen;
		$this->Inscripcion = $Inscripcion;
		$this->Eliminada = $Eliminada;
		$this->Grupo = $Grupo;
		$this->Ronda = $Ronda;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setNombre($Nombre)
	{
		$this->Nombre=$Nombre;
	}
	function getNombre()
	{
		return $this->Nombre;
	}
	function setSerie($Serie)
	{
		$this->Serie=$Serie;
	}
	function getSerie()
	{
		return $this->Serie;
	}
	function setImagen($Imagen)
	{
		$this->Imagen=$Imagen;
	}
	function getImagen()
	{
		return $this->Imagen;
	}
	function setInscripcion($Inscripcion)
	{
		$this->Inscripcion=$Inscripcion;
	}
	function getInscripcion()
	{
		return $this->Inscripcion;
	}
	function setEliminada($Eliminada)
	{
		$this->Eliminada=$Eliminada;
	}
	function getEliminada()
	{
		return $this->Eliminada;
	}
	function setGrupo($Grupo)
	{
		$this->Grupo=$Grupo;
	}
	function getGrupo()
	{
		return $this->Grupo;
	}
	function setRonda($Ronda)
	{
		$this->Ronda=$Ronda;
	}
	function getRonda()
	{
		return $this->Ronda;
	}
}
?>