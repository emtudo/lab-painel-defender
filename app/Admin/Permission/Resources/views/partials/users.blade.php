<div class="panel panel-default">
    <div class="panel-heading">Usuários:</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </span>
                    <input type="search" placeholder="Filtrar usuários" ng-model="user" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <p>Total: @{{ resultUser.length }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedUser"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllUser"
                               ng-click="checkAllUser()"/>
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
                    <th><a href ng-click="orderUser('Usuario')">Usuário</a></th>
                    <th><a href ng-click="orderUser('Nome')">Nome</a></th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="user in listUser | filter:user as resultUser">
                    <td><input type="checkbox" value="@{{user.id}}"
                               ng-model='user.selected'/>
                    </td>
                    <td>
                        <a href ng-click="personDetails(user.contato)"
                           data-toggle="modal"
                           data-target="#modelPersonDetalhe">@{{user.name}}</a>
                    </td>
                    <td>
                        <a href ng-click="personDetails(user.contato)"
                           data-toggle="modal"
                           data-target="#modelPersonDetalhe">@{{user.name}}</a>
                    </td>
                    <td>
                        <a href
                           ng-click="showUrl('{{ route('admin.permission.show.user','') }}',user.id)"
                           class="btn btn-xs btn-info">Editar</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="keepSelectedUser"/>
                        Manter itens selecionados quando usar filtrar
                    </label>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectedAllUser"
                               ng-click="checkAllUser()"/>
                        Selecionar tudo
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>