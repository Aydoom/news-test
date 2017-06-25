var newsApp = angular.module('newsApp', ['infinite-scroll']);

newsApp.controller('newsCtrl', function($scope, $http){
    $scope.data = {};
    
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
        $http.get('news', {
            params:{
                countNews: $scope.articles.length,
                keyword: $scope.keyword,
                search: $scope.search
            }
            }).then(function(data){
                //console.log(data.data);

                for(var i = 0; i < data.data.length; i++) {
                    var a = data.data[i];
                    a.dateMS = Date.parse(a.registerDate);
                    $scope.articles.push(a);
                }
                if (data.data.length !== 0) {
                    $scope.download = true;
                }
            }, function(data){
        });
    };
    
    $scope.createNews = function() {        
        if ($scope.form.keywords_str !== undefined) {
            $scope.form.keywords = $scope.form.keywords_str.split(",")
                    .map(function(s) { return s.trim(); });

            delete $scope.form.keywords_str;
        }
        
        $http.put('news', {
            params:{
                form: $scope.form
            }
            }).then(function(data){
                console.log(data);
                $scope.articles = [];
                $scope.hideForm();
                $scope.loadNews();
                alert('Добавлено успешно!');
            }, function(){
                alert('Не удалось добавить!');
        });
    };
    
    $scope.updateNews = function(index) {
        
        if ($scope.form.keywords_str !== undefined) {
            $scope.form.keywords = $scope.form.keywords_str.split(",")
                            .map(function(s) { return s.trim(); });
        }
        
        $http.post('news', {
            params:{
                form: $scope.form
            }
            }).then(function(data){
                $scope.articles[index] = data.data;
                $scope.hideForm();
                delete $scope.form.keywords_str;
                alert('Изменено успешно!');
            }, function(){
                alert('Не удалось изменить!');
        });
    };
    
    $scope.deleteNews = function(index) {
        id = $scope.articles[index].id;
        $http.delete('news', {
            params:{
                id: id
            }
            }).then(function(data){
                $scope.articles.splice(index, 1);
                alert('Удалено успешно!');
            }, function(){
                alert('Не удалось удалить!');
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
        for (var prop in $scope.articles[index]) {
            $scope.form[prop] = $scope.articles[index][prop];
        }
        
        $scope.form.index = index;
        $scope.form.keywords_str = $scope.form.keywords.join(", ").replace(/((,| )+)$/gi,"");
        $scope.showForm();
        
        $scope.titleForm = "Редактировать новость: \"" 
                + $scope.articles[index].title + "\"";
        $('.btn-update').show().siblings('.btn-create').hide();
        $scope.isShowForm = true;
    };
    
    
    $scope.hideForm = function() {
        $scope.form = {};
        $scope.isShowForm = false;
        $scope.container.removeClass("container-shadow");
    };
    
    
    $scope.showEmptyForm = function() {
        $scope.form = {};
        $('.btn-create').show().siblings('.btn-update').hide();

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
