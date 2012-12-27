<?php
require_once "PersonajeBD.php";
class Personaje extends PersonajeBD
{
	function Personaje($Id="",$Nombre="",$Serie="",$Imagen="")
	{
		$this->Id=$Id;
		$this->Nombre=$Nombre;
		$this->Serie=$Serie;
		$this->Imagen=$Imagen;
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
}
?>