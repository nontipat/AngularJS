<?php require ("dbconn.php");?>
<?php
	$sqllogin = "SELECT * FROM tb_login WHERE l_user = '".mysql_real_escape_string($_POST['User'])."' 
	and l_pass = '".mysql_real_escape_string($_POST['Pass'])."'";
	$Query = mysql_query($sqllogin);
	$Result = mysql_fetch_array($Query);
	if(!$Result)
	{
			header("location:product_list.php");
	}
	else
	{
			$_SESSION["UserID"] = $Result["l_id"];
			$_SESSION["Status"] = $Result["l_status"];

			session_write_close();
			
			if($Result["l_status"] == 500)
			{
				header("location:admin_page.php");
			}
			else
			{
				header("location:user_page.php");
			}
	}
?>