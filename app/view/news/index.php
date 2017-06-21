<html ng-app="newsApp">
    <head>
        <title>Angular Test</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/angular.min.js"></script>
        <script src="js/ng-infinite-scroll.min.js"></script>
        <script src="js/controllers.js"></script>
    </head>
    
    <body class="container" ng-controller="newsCtrl">

        <!-- BEGIN MODAL WINDOW -->
        <div class="window">
            <div class="row">
                <div class="col-lg-10">
                    <p>Окно редактирования и добавления новостей</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form>
                      <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{form.title}}">
                      </div>
                      <div class="form-group">
                        <label for="shortText">Краткое описание</label>
                        <textarea class="form-control" id="shortText" rows="3">{{form.shortText}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="keywords">Ключевые слова (через запятую)</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" value="{{form.keywords}}">
                      </div>
                      <button type="submit" class="btn btn-default">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL WINDOW -->
        
        <!-- BEGIN LIST OF NEWS -->
        <div class="news">
            <ul infinite-scroll="loadMore()">
                <li ng-repeat="(index, article) in articles">
                    <div class="row">
                        <div class="col-lg-10">
                            <h2>{{index + 1}} - {{article.title}}</h2>
                        </div>
                        <div class="col-lg-2">
                            <p>{{article.date}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <span ng-repeat="keyword in article.keywords">{{keyword}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{article.shortText}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="#" ng-click="changeNews(index)">Change</a>
                            <a href="#">Delete</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--END LIST OF NEWS -->
    </body>
</html>



