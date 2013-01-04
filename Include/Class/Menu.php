<?php
require_once "MenuBD.php";
class Menu extends MenuBD
{
	function Menu($Id="",$IdDependencia="",$Titulo="",$Descripcion="")
	{
		$this->Id = $Id;
		$this->IdDependencia = $IdDependencia;
		$this->Titulo = $Titulo;
		$this->Descripcion = $Descripcion;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setIdDependencia($IdDependencia)
	{
		$this->IdDependencia=$IdDependencia;
	}
	function getIdDependencia()
	{
		return $this->IdDependencia;
	}
	function setTitulo($Titulo)
	{
		$this->Titulo=$Titulo;
	}
	function getTitulo()
	{
		return $this->Titulo;
	}
	function setDescripcion($Descripcion)
	{
		$this->Descripcion=$Descripcion;
	}
	function getDescripcion()
	{
		return $this->Descripcion;
	}
}
?>
