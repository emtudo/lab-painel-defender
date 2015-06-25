<div class="panel panel-default">
    <div class="panel-heading">Permissões</div>
    <div class="panel-body">
        <div class="row">
        @if(Route::currentRouteNamed("admin.permission.resetall"))
            <div class="col-sm-6">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-search"></i>
                </span>
                    <input type="search" placeholder="Filtrar permissões"
                           ng-model="permission" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <p>Total: @{{ resultPermission.length }}</p>
            </div>
        @else
            <div class="col-sm-12">
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-search"></i>
                </span>
                    <input type="search" placeholder="Filtrar permissões"
                           ng-model="permission" class="form-control">
                </div>
            </div>
        @endif
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedPermission"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllPermission"
                               ng-click="checkAllPermission()"/>
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
                    <th><a href ng-click="orderPermission('readable_name')">Ordernar</a></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="permission in listPermission | filter:permission as resultPermission">
                    <td><input type="checkbox" value="@{{permission.id}}"
                               ng-model='permission.selected'/>
                    </td>
                    <td>@{{permission.readable_name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedPermission"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllPermission"
                               ng-click="checkAllPermission()"/>
                        Selecionar tudo
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>