var app = angular.module('myApp', []);

app.controller('myCtrl', function($scope, $http) {
    $http.get("select.php")
    .then(function(response) {
        $scope.product = response.data;
    });
});
app.controller('calCtrl', function($scope, $http) {
    $http.get("order.php")
    .then(function(response) {
        $scope.product = response.data;
    });
	$scope.add = function(product){
	product.cal_num++;
	}

	$scope.remove = function(product){
		if(product.cal_num > 1){
			product.cal_num--;
		}		
	}
	$scope.totalPrice = function(){
		var total = 0;
		$scope.product.forEach(function(data){
			total += data.cal_price*data.cal_num;
		});
		return total;
	}
});
