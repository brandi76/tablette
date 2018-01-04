// Code goes here

var myApp = angular.module('myApp', ['angularUtils.directives.dirPagination']);

function MyController($scope) {

  $scope.currentPage = 1;
  $scope.pageSize = 10;
  $scope.collection = [];
 
  for (var i = 1; i <= 12; i++) {
    $scope.collection.push('item ' + i);
  }
}


myApp.controller('MyController', MyController);