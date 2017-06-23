<div ng-show="isShowForm" class="panel panel-msg panel-primary ng-hide"
    <div class="panel-body">
        <div class="panel-header">
            <div class="row">
                <div class="col-lg-11">
                    <h3 class="panel-title">{{titleForm}}</p>
                </div>
                <div class="col-lg-1 text-right">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true" ng-click="hideForm()"></span>
                </div>
            </div>
        </div>
        <div class="panel-form">
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
                        <div class="row">
                            <div class="col-lg-6">
                                <button ng-click="form={}" type="submit" class="btn btn-default">Очистить</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="submit" class="btn btn-primary">{{btnSave}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
