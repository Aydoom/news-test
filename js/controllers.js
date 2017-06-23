var newsApp = angular.module('newsApp', ['infinite-scroll']);

newsApp.controller('newsCtrl', function($scope, $http){
    $scope.data = {};
    
    $scope.page = 1;
    $scope.download = true;
    $scope.articles = [];
    
    $scope.isShowForm = false;
    $scope.form = {};
    $scope.titleForm;
    $scope.btnSave;
    
    $scope.keyword = '';
    $scope.search = '';
    
    $scope.container = angular.element(document.querySelector('.container'));
    
    
    $scope.loadNews = function() {
        console.log($scope.keyword);
        $http.get('news/show', {
            params:{
                page: $scope.page,
                keyword: $scope.keyword,
                search: $scope.search
            }
            }).then(function(data){
                /*$scope.data.data = data.data;*/
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
        $scope.showForm();
        
        $scope.titleForm = "Редактировать новость: \"" 
                + $scope.articles[index].title + "\"";
        $scope.btnSave = "Изменить";
    };
    
    
    $scope.hideForm = function() {
        $scope.form = {};
        $scope.isShowForm = false;
        $scope.container.removeClass("container-shadow");
    };
    
    
    $scope.showEmptyForm = function() {
        $scope.form = {};
        $scope.showForm();
        
        $scope.titleForm = "Добавить новость";
        $scope.btnSave = "Добавить";
    };
    
    
    $scope.showForm = function() {
        $scope.isShowForm = true;
        $scope.container.addClass("container-shadow");
    };
    
    $scope.findKeyword = function(keyword) {
        $scope.keyword = keyword;
        $scope.page = 1;
        $scope.articles = [];
        $scope.loadNews();
    };
    
    $scope.clearFilter = function() {
        $scope.keyword = '';
        $scope.page = 1;
        $scope.articles = [];
        $scope.loadNews();
    };
    
    $scope.findTitle = function() {
        $scope.page = 1;
        $scope.articles = [];
        $scope.loadNews();
    };
});
