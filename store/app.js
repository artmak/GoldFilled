(function() {
	angular.module('GoldFilledStore', ['ngCart'])
	
	.controller('StoreController',[ '$http','ngCart', '$scope', function ($http, ngCart, $scope) {

        ngCart.setShipping(0);
        ngCart.setTaxRate(0);
    
        


    $http({method: 'GET', url: 'data/goldfilled.json'})
        .success(function(data, status, headers, config) {
            $scope.products = data;
        })
        .error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
        });
		
		


	}])

	.controller('Cart',['ngCart', '$log', '$scope', function (ngCart,$log, $scope) {
    $scope.showCart = function(){

        $log.info ('---Total Cost:---');
        $log.info (ngCart.totalCost());
        $log.info ('---Items in Cart:---');
        $log.info (ngCart.getItems());

    }

	}])
	
	
	
	.controller('ContactController', function ($scope, $http) {
    $scope.result = 'hidden'
    $scope.resultMessage;
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(contactform) {
        $scope.submitted = true;
        $scope.submitButtonDisabled = true;
        if (contactform.$valid) {
            $http({
                method  : 'POST',
                url     : 'contact-form.php',
                data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    $scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
                } else {
                    $scope.submitButtonDisabled = false;
                    $scope.resultMessage = data.message;
                    $scope.result='bg-danger';
                }
            });
        } else {
            $scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Failed :( Пожалуйста, заполните все поля.';
            $scope.result='bg-danger';
        }
    }
	})
}) 

();
