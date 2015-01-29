'use strict';
app.factory('loginService',function($http, $location, sessionService){
	return{
		login:function(data,scope){
			$http.post('./server/admin/user.php',data).success(function(data){
				console.log(data);
				if(data.response_number==1){
					sessionService.set('uid',data.uid);
					$location.path('/home');
				}	       
				else  {
					scope.msgtxt='Invalid username and password';
					$location.path('/login');
				}				   
			}).error(function(data) {
				console.log(data);
			});
		},
		logout:function(){
			sessionService.destroy('uid');
			console.log('sds');
			$location.path('/login');
		},
		islogged:function(){
			var $checkSessionServer=$http.post('./server/admin/check_session.php');
			return $checkSessionServer;
		}
	}

});