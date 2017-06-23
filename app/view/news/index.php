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
    {{data.data}}
    <body class="container" ng-controller="newsCtrl" >
        <!-- BEGIN MODAL WINDOW -->
       <div class='row'>
            <div class="col-lg-10 col-lg-offset-1">
                <?php require ELEMENT . 'modal_window.php' ?>
            </div>
        </div>
        <!-- END MODAL WINDOW -->
        
        <!-- BEGIN SHADOW -->
       <div class='row'>
            <div ng-show="isShowForm" class="col-lg-12 shadow">
            </div>
        </div>
        <!-- END SHADOW -->
        
        <!-- BEGIN BUTTON FOR OPEN MODAL WINDOW -->
       <div class='row'>
            <div class="col-lg-11 text-right">
                <button type="submit" class="btn btn-primary" ng-click="showEmptyForm()">Добавить Новость</button>
            </div>
        </div>
        <!-- END BUTTON FOR OPEN MODAL WINDOW -->

        <!-- BEGIN SEARCH -->
        <div class='row'>
            <div class="col-lg-10 col-lg-offset-1">
                <?php require ELEMENT . 'search.php' ?>
            </div>
        </div>
        <!--END SEARCH --> 
        
        <!-- BEGIN FILTER -->
        <div class='row'>
            <div class="col-lg-10 col-lg-offset-1">
                <?php require ELEMENT . 'filter.php' ?>
            </div>
        </div>
        <!--END FILTER -->
        
        <!-- BEGIN LIST OF NEWS -->
        <div class='row'>
            <div class="col-lg-10 col-lg-offset-1">
                <?php require ELEMENT . 'news.php' ?>
            </div>
        </div>
        <!--END LIST OF NEWS -->
        
    </body>
</html>



