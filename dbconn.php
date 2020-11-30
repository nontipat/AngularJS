<?php 
	mysql_connect("localhost","root","1234");
	mysql_select_db("sqltest") or die(mysql_error());
	mysql_query("SET NAMES UTF8");	
?>