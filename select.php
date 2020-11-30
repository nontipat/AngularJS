<?php
	mysql_connect('localhost','root','1234');
	mysql_select_db('sqltest');
	mysql_query('set names utf8');

	$sql = "select * from tb_product";
	$result = mysql_query($sql);
	$data = null;

	while($row = mysql_fetch_assoc($result)){
		$data[] = $row;
	}

	echo json_encode($data);
?>