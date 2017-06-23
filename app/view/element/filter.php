<div class="filter" ng-if="keyword!==''" class="animate-if">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            Поиск по ключевому слову: 
            <button type="button" ng-click="clearFilter()" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    {{keyword}}
            </button>
        </div>
    </div>
</div>

