<div class="panel panel-default">
    <div class="panel-heading">Acesso total a sessões</div>
    <div class="panel-body">
        <div class="row">
            @if(Route::currentRouteNamed("admin.permission.resetall"))
                <div class="col-sm-6">
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </span>
                        <input type="search" placeholder="Filtrar sessões" ng-model="session"
                               class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <p>Total: @{{ resultSession.length }}</p>
                </div>
            @else
                <div class="col-sm-12">
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-search"></i>
                    </span>
                        <input type="search" placeholder="Filtrar sessões" ng-model="session"
                               class="form-control">
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedSession"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllSession"
                               ng-click="checkAllSession()"/>
                        Selecionar tudo
                    </label>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th><a href ng-click="orderSession('name')">Ordernar</a></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="session in listSession | filter:session as resultSession">
                    <td><input type="checkbox" value="@{{session.id}}"
                               ng-model='session.selected'/>
                    </td>
                    <td>@{{session.name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedSession"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllSession"
                               ng-click="checkAllSession()"/>
                        Selecionar tudo
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>