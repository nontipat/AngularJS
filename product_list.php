<?php require ("dbconn.php");?>
<?php
session_start();
if(isset($_POST["submit"])){
	if(move_uploaded_file($_FILES["img"]["tmp_name"],"image/product/".$_FILES["img"]["name"])){
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
<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
#btn{
	width:120px; 
	height:35px; 
	border-radius:10px; 
	font-size:18px;
	background-color:#0FF; 	
}
#btn:hover{
	background-color:#00A6A6;
}
<?php if($_SESSION['l_status'] == 500){ ?>	
#product{width:73%;}
#item{
	background:rgba(124, 157, 188, 0.4);
	float:left; 
	width:180px; 
	height:300px; 
	margin:10px 10px 10px 10px;
	padding: 10px;
}
#listP{
	width:96%;
	background:rgba(124, 157, 188, 0.4); 
	padding: 10px 15px;	
	margin-left: 2.2%;
}
#listF{
	display: none;
<?php } ?>
<?php if($_SESSION['l_status'] != 500){ ?>
#product{width:102.5%;}
#item{
	background:rgba(124, 157, 188, 0.4);
	float:left; 
	width:180px; 
	height:300px; 
	margin:10px 20px 10px 20px;
	padding: 10px;
}
#listP{
	background:rgba(124, 157, 188, 0.4); 
	padding: 10px;
	text-align: center;
}
#listF{
	margin-right:21%;
	margin-left:27%;
	font-size: 24px;
	color: white;
}
<?php } ?>
#footer{
	background-color:#F0F0F0; 
	border: 1px solid #CDCDCD; 
	margin-top:20px; 
	height: 35px; 
	border-radius: 5px;
}
#textf{
	color: #000000;
	text-shadow:-1px 0 #9AFDFA, 0  1px #9AFDFA, 
				 1px 0 #9AFDFA, 0 -1px #9AFDFA;
}	
</style>
</head>

<body ng-controller="myCtrl" background="image/QQQ.jpg">
<div class="container">
	<nav class="navbar navbar-default">
	<div class="container-fluid">
	  <div class="navbar-header">
	    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	      <span class="sr-only"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href="#">Project name</a>
	  </div>
	  <div id="navbar" class="navbar-collapse collapse">
	    <ul class="nav navbar-nav">
	      <li><a href="#">หน้าแรก</a></li>
	      <li class="active"><a href="#">รายการสินค้า</a></li>
	      <li><a href="#">เกี่ยวกับเรา</a></li>
	      <li><a href="#">ติดต่อเรา</a></li>
	      
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
<?php if(!isset($_SESSION['l_status'])){ ?>	 
	    	<li><a href="#">ลงทะเบียน</a></li>
	      	<li><a href="#" data-toggle="modal" data-target="#myLogin">เข้าสู่ระบบ</a></li>
<?php } ?>
<?php if($_SESSION['l_status'] == 500 || $_SESSION['l_status'] == 1){ ?>
			<li><a href="#">สวัสดีคุณ : <?php echo $_SESSION['l_user'];?></a></li>
			<li><a ><font color="#D7D5D5">|</font></a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ตั้งค่า <span class="caret"></span></a>
			    <ul class="dropdown-menu">
			      <li><a href="#">แก้ไขข้อมูลส่วนตัว</a></li>
			      <li><a href="#">เปลี่ยนรหัสผ่าน</a></li>
			      <li><a href="#">รายงานปัญหา</a></li>
			      <li role="separator" class="divider"></li>
			      <li><a href="#">ความช่วยเหลือ</a></li>
			      <li><a href="logout.php">ออกจากระบบ</a></li>
			    </ul>
		    </li>
<?php } ?>	      	      
	    </ul>
	  </div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
	</nav>

<div id="listP">
	<form class="form-inline">	
		<font id="listF">สินค้าทั้งหมด {{product.length}} รายการ</font>
		<select ng-model="sortBy" class="form-control">
			<option value="">--เรียงลำดับ--</option>
			<option value="p_price">ราคาน้อยไปมาก</option>
			<option value="-p_price">ราคามากไปน้อย</option>
		</select>
		<input type="text" ng-model="search" class="form-control" placeholder="Search...">
	</form>
</div>	

<div id="product" class="col-md-8 container-fluid">
<div align="right" class="container-fluid">	
</div>
	<div id="item" ng-repeat="x in product | orderBy:sortBy | filter:search">
		<table width="150" height="280" align="center">
			 <tr>
			    <td>
			        <div align="center">
					  <img src="image/product/{{ x.p_img }}" width="150" height="150" />
			          <hr />
					  <font color="#FFFFFF">{{ x.p_name | limitTo: 20 }}</font>
					  <br/>
			         <font color="#FF0000">{{ x.p_price | currency:'฿ ' }}</font>
<?php if($_SESSION['l_status'] != 500){ ?>
			         <form action="product_cal.php" method="POST" style="margin-top: 10px;>
			            <input name="number" type="hidden" value="1" />			            
			            <input class="btn btn-info" name="btn" type="submit" value="หยิบใส่ตะกร้า" />	            
			        </form>
<?php } ?>
<?php if($_SESSION['l_status'] == 500){ ?>
			        <form>
			        	<a class="btn btn-warning" href="product_edit.php?ID={{x.p_id}}">แก้ไข</a>
			        	<a class="btn btn-danger" href="product_del.php?ID={{x.p_id}}" 
			        	   onclick="return confirm('ยืนยันการลบข้อมูล?')">ลบ</a>
			        </form>
<?php } ?>	
			        </div>        
			 	</td>
			 </tr>
		 </table>
	 </div>
 </div>
 <?php if($_SESSION['l_status'] == 500){ ?>
 <div style="background-color:rgba(142, 142, 142, 0.6); width:25%;color: white; margin-top: 10px;" class="col-md-4 container-fluid">
 <h4 align="center">สินค้าทั้งหมด {{product.length}} รายการ</h4><hr>
 <h3 align="center"><strong>เพิ่มรายการสินค้า</strong></h3>
 	<div class="panel-body">
		<form action="" method="POST" enctype="multipart/form-data">
        	<p>รูปภาพ: {{p_img}}<br>
    		<input type="file" name="img" required />
	        </p>
	        <p>ชื่อสินค้า:<br>
	        <input class="form-control" type="text" name="name" required>    
	        </p>	        
	        <p>ราคา:<br>
	        <input class="form-control" type="text" name="price" required>       
	        </p>	        
	        <p>จำนวน:<br>
	        <input class="form-control" type="text" name="num" required>
	        </p>
            <input style="width: 225px;" class="btn btn-success" type="submit" name="submit" value="เพิ่มสินค้า" />
        </form>  
    </div>
 </div>
<?php } ?>
<footer id="footer" class="container-fluid col-lg-12">	
	<h5 id="textf"><strong>Copyright@ 2016</strong></h5>
</footer>

<div class="modal fade" id="myLogin" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 align="center" class="form-signin-heading">เข้าสู่ระบบ</h2>
        </div>
        <div class="modal-body">
          <form class="form-signin" method="post" action="login.php" >
	        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus><br>
	        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><hr>
	        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login"/>	        
	      </form>         
      </div>      
    </div>
  </div>


</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script src="js/angular.min.js"></script>
<script src="app.js" ></script>

</body>
</html>
