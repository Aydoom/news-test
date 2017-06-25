<div class="news">
    <ul infinite-scroll="loadMore()">
        <li ng-repeat="(index, article) in articles">
            <div class="panel panel-news panel-default"
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10">
                            <h2>{{index + 1}} - {{article.title}}</h2>
                        </div>
                        <div class="col-lg-2">
                            <p ng-non-bindable>{{article.date | date:'dd.MMM.y' }}</p>
                        </div>
                    </div>
                    <div class="row row-keywords">
                        <div class="col-lg-12">
                            <span ng-repeat="keyword in article.keywords track by $index" 
                                  ng-click="findKeyword(keyword)" 
                                  class="label label-default">{{keyword}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{article.shortText}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <button type="button" class="btn btn-default" ng-click="changeNews(index)">Change</button>
                                <button type="button" class="btn btn-default">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

