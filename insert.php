<?php require ("dbconn.php");?>
<?php
if(isset($_POST["submit"])){
	if(move_uploaded_file($_FILES["img"]["tmp_name"],"image/".$_FILES["img"]["name"])){
		$strSQL = "INSERT INTO tb_product (p_img, p_name, p_price, p_num) 
					VALUES ('".$_FILES["img"]["name"]."','".$_POST["name"]."',
							'".$_POST["price"]."','".$_POST["num"]."') ";
		$objQuery = mysql_query($strSQL);
		if($objQuery){		
				echo "<script>alert('เพิ่มรายการสินค้าเรียบร้อยแล้ว')</script>";
				echo "<script>window.location='product_list.php'</script>";
		}
	}
	else{
		echo "ไม่สามารถเพิ่มข้อมูลได้ [".$strSQL."]";
	}
}
?>