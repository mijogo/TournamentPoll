<?php
require_once "ExhibicionBD.php";
class Exhibicion extends ExhibicionBD
{
	function Exhibicion($IdBatalla="",$IdPersonaje="")
	{
		$this->IdBatalla = $IdBatalla;
		$this->IdPersonaje = $IdPersonaje;
	}
	function setIdBatalla($IdBatalla)
	{
		$this->IdBatalla=$IdBatalla;
	}
	function getIdBatalla()
	{
		return $this->IdBatalla;
	}
	function setIdPersonaje($IdPersonaje)
	{
		$this->IdPersonaje=$IdPersonaje;
	}
	function getIdPersonaje()
	{
		return $this->IdPersonaje;
	}
}
?>
