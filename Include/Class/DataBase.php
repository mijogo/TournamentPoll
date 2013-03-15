<?php
class DataBase
{
	function DataBase(){}
	
	function connect()
	{
		$this->con = mysql_connect(SERVER,USER,PASS);
		if (!$this->con)
			die('Could not connect: ' . mysql_error());
		mysql_select_db(MYDB, $this->con);
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