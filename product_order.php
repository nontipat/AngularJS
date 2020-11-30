<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="myApp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src= "https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<style>
/*#ta:nth-child(even) {background: #CCC}
#ta:nth-child(odd) {background: #FFF}*/
th{
    text-align: center;
}
</style>
</head>

<body ng-controller="calCtrl">
<div style="height:100px;"></div>
<center>    
<table class="table table-hover" style="width:1000px;">
	<tr>
    	<th>รูปภาพ</th>
        <th>ลำดับ</th>
    	<th>ชื่อสินค้า</th>
        <th>ราคา/ชิ้น</th>
        <th>จำนวน</th>
        <th>ราคารวม</th>
    </tr>
    <tr id="ta" ng-repeat="x in product">
    	<td width="80"><img src="img/{{ x.cal_img }}" width="80" height="80" /></td>
        <td align="center">{{$index+1}}</td>
        <td>{{ x.cal_name }}</td>
        <td align="center">{{ x.cal_price }}</td>
        <td align="center">
            <a ng-click="remove(x)" href="#"><i class="glyphicon glyphicon-minus"></i></a>
            {{x.cal_num}}
            <a ng-click="add(x)" href="#"><i class="glyphicon glyphicon-plus"></i></a>
        </td>
        <td align="center">{{ x.cal_price*x.cal_num }}</td>
    </tr>
    <tr> 
   	  <td colspan="4" align="right" ></td>
        <th align="center">รวม</th>
        <td align="center">{{ totalPrice() }}</td>
    </tr>
</table>
<div style="text-align: right; width: 1000px;">
    <form>
    <ul style="list-style-type: none;">
        <li ng-repeat="x in product">
            <input type="hidden" name="price" value="{{ x.cal_price }}">
            <input type="hidden" name="number" value="{{ x.cal_num }}">
            <input type="hidden" name="" value="{{ x.cal_price*x.cal_num }}">
        </li>
    </ul>
        <input type="hidden" name="" value="{{ totalPrice() }}">
        <input class="btn btn-success" type="submit" name="" value="ยืนยันคำสั่งซื้อ">
    </form>
</div>
</center>
<script src="app.js" ></script>
</body>
</html>