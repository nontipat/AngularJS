<?php
	session_start();
	session_destroy();
	header("location:product_list.php");
?>