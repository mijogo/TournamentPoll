<?php
require_once "AdminBD.php";
class Admin extends AdminBD
{
	function Admin($Id="",$User="",$Pass="",$Mail="",$Authpass="",$Nivel="")
	{
		$this->Id = $Id;
		$this->User = $User;
		$this->Pass = $Pass;
		$this->Mail = $Mail;
		$this->Authpass = $Authpass;
		$this->Nivel = $Nivel;
	}
	function setId($Id)
	{
		$this->Id=$Id;
	}
	function getId()
	{
		return $this->Id;
	}
	function setUser($User)
	{
		$this->User=$User;
	}
	function getUser()
	{
		return $this->User;
	}
	function setPass($Pass)
	{
		$this->Pass=$Pass;
	}
	function getPass()
	{
		return $this->Pass;
	}
	function setMail($Mail)
	{
		$this->Mail=$Mail;
	}
	function getMail()
	{
		return $this->Mail;
	}
	function setAuthpass($Authpass)
	{
		$this->Authpass=$Authpass;
	}
	function getAuthpass()
	{
		return $this->Authpass;
	}
	function setNivel($Nivel)
	{
		$this->Nivel=$Nivel;
	}
	function getNivel()
	{
		return $this->Nivel;
	}
}
?>