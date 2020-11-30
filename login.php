<?php require ('dbconn.php'); ?>
<?php    
    session_start();
    $sqllogin = "SELECT * FROM tb_login WHERE l_user = '$_POST[username]' AND l_pass = '$_POST[password]'";
    $result = mysql_query($sqllogin);
    if (!$result) {
        die(mysql_error());
    }
    $user = mysql_fetch_array($result);
    $_SESSION['l_status'] = $user['l_status'];
    $_SESSION['l_user'] = $user['l_user'];
    session_write_close();
    header("location:product_list.php");
?>