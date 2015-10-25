<?php
class mysql
{
	var $link;
	function mysql()
	{
		
	}
	
	function conectar()
	{
		if($this->link=mysql_connect("localhost","root",""))
		{
			if(mysql_select_db("infantcable",$this->link))
			{
				return true;
			}
			else
				return false;
			
		}
		else
			return false;
	}
	
	function query($sql)
	{
		$res=mysql_query($sql,$this->link);
		return $res;
	}
}
?>