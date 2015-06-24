var app = angular.module('app', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('||');
	$interpolateProvider.endSymbol('||');
});

app.controller('geralController', ['$scope', function($scope) {
	$scope.janela=window.name;
}]);

