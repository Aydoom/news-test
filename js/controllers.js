var newsApp = angular.module('newsApp', ['infinite-scroll']);

newsApp.controller('newsCtrl', function($scope, $http){
    $scope.page = 1;
    $scope.download = true;
    $scope.articles = [];
    $scope.form = {};
    
    $scope.loadNews = function() {
        $http.get('news/show', {params:{page: $scope.page}}).then(function(data){
            $scope.page = $scope.page + 1;

            for(var i = 0; i < data.data.length; i++) {
                var a = data.data[i];
                $scope.articles.push(a);
            }
            if (data.data.length !== 0) {
                $scope.download = true;
            }
        }, function(data){
        });
    };
    
    $scope.loadMore = function() {

        if (document.body.offsetHeight - window.screen.height < $(window).scrollTop()
                || $scope.articles.length === 0) {
            if ($scope.download) {
                $scope.download = false;
                $scope.loadNews();
            }
        }
    };
    
    $scope.changeNews = function(index) {
        $scope.form = $scope.articles[index];
    };
});
