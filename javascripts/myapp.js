app = angular.module("MyApp", ["ngRoute","ngSanitize",'ui.bootstrap']);

// all environments
app.config(['$routeProvider',
    function($routeProvider) {
     
        $routeProvider.
                when('/HOME', {
                    templateUrl: 'view/home.html',
                    controller: 'HomeCtrl'
                }).
                when('/MISSION', {
                    templateUrl: 'view/mission.html',
                    controller: 'MissionCtrl'
                }).
                when('/TOURS', {
                    templateUrl: 'view/tour.html',
                    controller: 'TourCtrl'
                }).
                     when('/STORIES', {
                    templateUrl: 'view/stories.html',
                    controller: 'StoryCtrl'
                }).
                when('/STORIES/:story_id', {
                    templateUrl: 'view/story_det.html',
                    controller: 'StoryDetCtrl'
                }).
                    when('/HOT/:hot_id', {
                    templateUrl: 'view/hot_det.html',
                    controller: 'HotDetCtrl'
                }).
                       when('/ABOUT', {
                    templateUrl: 'view/aboutus.html',
                    controller: 'ABoutCtrl'
                }).
                           when('/CONTACT', {
                    templateUrl: 'view/contact.html',
                    controller: 'ContactCtrl'
                }).
                  when('/TOURS/:tour_id', {
                    templateUrl: 'view/tour_det.html',
                    controller: 'TourCtrlDet'
                }).
                otherwise({
                    redirectTo: '/HOME'
                });
               
    }]);
app.factory('Language',function (){

   return 1; 
});

app.controller("MissionCtrl", function($scope,$http,Language) {


    $scope.tabs = [{
             id:'1',
            title: 'TRAVEL TO HELP',
            url: 'view/mission_det.html'
        }, {
            id:'2',
            title: 'WARMTH',
            url: 'view/warmth.html'
        }];
            $scope.states = {};
    $scope.states.activeItem = '1';
            $scope.currentTab = 'view/mission_det.html'
                $scope.onClickTab = function (tab) {
        $scope.currentTab = tab.url;
         $scope.states.activeItem=tab.id
    }   
    



$http.get("/datas/mission").success(function(data) {
             
                $scope.mission = data.data;
            
        }).error(function(data) {
            console.log(data);
        });
  $http.get("/datas/warmth").success(function(data) {
             
                $scope.warmth = data.data;
            
        }).error(function(data) {
            console.log(data);
        });
$http.get("/datas/aboutUs/"+Language).success(function(data) {
  
                $scope.m1 = data.data.text;
            
        }).error(function(data) {
            console.log(data);
        });


});

app.controller("BodyCtrl",function($scope){
     var def={ "background-color": "#fff" };

  $scope.style =def;
    console.log($scope.style);
$scope.change=function(val){

    if(val==1)
    $scope.style={ "background-color": "#fff" };
else
      $scope.style=def;

}

});
app.controller("ContactCtrl", function($scope,$http) {
 $http.get("/datas/contact").success(function(data) {
             
                $scope.contact = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;

  
});
app.controller("StoryCtrl", function($scope,$http) {


  
});
app.controller("ABoutCtrl", function($scope,$http) {
});
app.controller("StoryCtrlList", function($scope,$http) {
    
    $http.get("/datas/story").success(function(data) {
                console.log(data.data.length);
                $scope.storyData = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});
app.controller('Gallery',function($scope,$http){

    $http.get("/datas/gallery").success(function(data) {
                console.log(data.data.length);
                $scope.gallery = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});
app.controller("HotCtrlList", function($scope,$http) {
    
    $http.get("/datas/hot").success(function(data) {
             
                $scope.hotData = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});
app.controller("HotDetCtrl", function($scope,$http, $routeParams) {


  $http.post("/datas/hotDet",{id:$routeParams.hot_id}).success(function(data) {
                if(data.response==1){
                console.log(data);
                $scope.hotData = data.data;
                
               
            }
        }).error(function(data) {
            console.log(data);
        });;
    


});
app.controller("StoryCtrlDet", function($scope,$http, $routeParams) {

    $scope.states = {};
    $scope.states.activeItem=0 ;
  $http.post("/datas/tourDet",{id:$routeParams.story_id}).success(function(data) {
                if(data.response==1){
           
                $scope.DetData = data.data;
                 $scope.singleData = data.data[0];
                  $scope.ImgAr = data.data[0].images.split(',');
                  $scope.image=data.data[0];
               
            }
        }).error(function(data) {
            console.log(data);
        });;
       $scope.showImage = function( index ) {
                    $scope.states.activeItem=index;
                    // Use -1 to adjust image for zero-based array.
                    $scope.image = $scope.DetData[index];
            
                };


});


app.controller("HomeCtrl", function($http, $scope,Language) {
//  $http.post("fb.com",{task:1}).success(function(data){
//      console.log(data);

 

$http.get("/datas/aboutUs/"+Language).success(function(data) {
  
                $scope.m1 = data.data.text;
            
        }).error(function(data) {
            console.log(data);
        });;

$http.get("/datas/homeInfo").success(function(data) {
  
                $scope.homeInfo= data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
// $http.get("/datas/missionData/"+Language).success(function(data) {
   
//                 $scope.m2 = data.data.text;
            
//         }).error(function(data) {
//             console.log(data);
//         });;

});

app.controller('LoginCtrl',function ($http,$scope){
  $scope.submit = function() {
      console.log($scope.user);
  }
      });

app.controller("TourCtrl", function($scope,$http) {
   $http.get("/datas/tour_info").success(function(data) {
                
                $scope.tourInfo = data.data[0];
            
        }).error(function(data) {
            console.log(data);
        });;
  
});

app.controller("TourCtrlList", function($scope,$http) {
    
    $http.get("/datas/tour").success(function(data) {
                
                $scope.toursData = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});

app.controller("TourCtrlDet", function($scope,$http, $routeParams) {

    $scope.states = {};
    $scope.states.activeItem=0 ;
  $http.post("/datas/tourDet",{id:$routeParams.tour_id}).success(function(data) {
                if(data.response==1){
           
                $scope.DetData = data.data;
                 $scope.singleData = data.data[0];
                  $scope.ImgAr = data.data[0].images.split(',');
                  $scope.image=data.data[0];
               
            }
        }).error(function(data) {
            console.log(data);
        });;
       $scope.showImage = function( index ) {
                    $scope.states.activeItem=index;
                    // Use -1 to adjust image for zero-based array.
                    $scope.image = $scope.DetData[index];
            
                };

    $http.get("/datas/addons").success(function(data) {
               
                $scope.addons = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
    
});



app.controller("HeaderCtrl", function($http, $scope) {
   
});
app.controller("FooterCtrl", function($http, $scope) {
       $http.get("/datas/tour").success(function(data) {
                
                $scope.toursData = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});

app.controller("FaqCtrl",function($http,$scope){
$http.get("/datas/faq").success(function(data) {
                console.log(data);
                $scope.faqData = data.data;
            
        }).error(function(data) {
            console.log(data);
        });;
});


// fade
   app.directive(
            "bnFadeHelper",
            function() {
 
                // I alter the DOM to add the fader image.
                function compile( element, attributes, transclude ) {
 
                    element.prepend( "<img class='fader' />" );
 
                    return( link );
 
                }
 
 
                // I bind the UI events to the $scope.
                function link( $scope, element, attributes ) {
 
                    var fader = element.find( "img.fader" );
                    var primary = element.find( "img.image" );
 
                    // Watch for changes in the source of the primary
                    // image. Whenever it changes, we want to show it
                    // fade into the new source.
                    $scope.$watch(
                        "image.tour_img",
                        function( newValue, oldValue ) {
 
                            // If the $watch() is initializing, ignore.
                            if ( newValue === oldValue ) {
 
                                return;
 
                            }
 
                            // If the fader is still fading out, don't
                            // bother changing the source of the fader;
                            // just let the previous image continue to
                            // fade out.
                            if ( isFading() ) {
 
                                return;
 
                            }
 
                            initFade( oldValue );
 
                        }
                    );
 
 
                    // I prepare the fader to show the previous image
                    // while fading out of view.
                    function initFade( fadeSource ) {
 
                        fader
                            .prop( "src", fadeSource )
                            .addClass( "show" )
                        ;
 
                        // Don't actually start the fade until the
                        // primary image has loaded the new source.
                        primary.one( "load", startFade );
 
                    }
 
 
                    // I determine if the fader is currently fading
                    // out of view (that is currently animated).
                    function isFading() {
 
                        return(
                            fader.hasClass( "show" ) ||
                            fader.hasClass( "fadeOut" )
                        );
 
                    }
 
 
                    // I start the fade-out process.
                    function startFade() {
 
                        // The .width() call is here to ensure that
                        // the browser repaints before applying the
                        // fade-out class (so as to make sure the
                        // opacity doesn't kick in immediately).
                        fader.width();
 
                        fader.addClass( "fadeOut" );
 
                        setTimeout( teardownFade, 250 );
 
                    }
 
 
                    // I clean up the fader after the fade-out has
                    // completed its animation.
                    function teardownFade() {
 
                        fader.removeClass( "show fadeOut" );
 
                    }
 
                }
 
 
                // Return the directive configuration.
                return({
                    compile: compile,
                    restrict: "A"
                });
 
            }
        );