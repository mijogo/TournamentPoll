<?php
class DataBase
{
	function DataBase(){}
	
	function connect()
	{
		$server="localhost";
		$username="root";
		$pass="";
		$mydb="PollTournament";
		$this->con = mysql_connect($server,$username,$pass);
		if (!$this->con)
			die('Could not connect: ' . mysql_error());
		mysql_select_db($mydb, $this->con);
	}
	function close()
	{
		mysql_close($this->con);
	}
	function querry($sql)
	{
		return mysql_query($sql);
	}
	function fetch($result)
	{
		return mysql_fetch_array($result);
	}
	
	function select($sql)
	{
		$this->connect();
		$result = $this->querry($sql);
		return $result;
	}
	
	function insert($sql)
	{
		$this->connect();
		$result = $this->querry($sql);
		$this->close();
		return $result;
	}
}
?>