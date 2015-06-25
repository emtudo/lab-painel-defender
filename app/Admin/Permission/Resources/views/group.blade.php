@extends('app')

@section('content')
<script>
	_permissionGroup={!! !empty($group)?$group:'""' !!};
	_permission={!! !empty($permission)?$permission:'""' !!};
</script>
<div id="result"></div>
<div class="container-fluid" ng-controller="appPermissionGroupController">
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading"><section id="addPemission">Permissão</section></div>
				<div class="panel-body">
					<input type="hidden" name="addIdGroup" ng-model="group.id">
					<div class="form-group">
						<label class="col-sm-1 control-label">Nome</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="name" ng-model="group.name" maxlength="45" placeholder="Nome">
						</div>
						<div class="col-sm-1" ng-hide="group.edit">
							<button type="button" type="submit" class="btn btn-primary" style="margin-right: 15px;" ng-click="save(group)">
								Salvar
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default" ng-hide="group.selectSelected=='selected'">
				<div class="panel-heading">
					<div class="input-group">
	                <span class="input-group-addon">
	                    <i class="glyphicon glyphicon-search"></i>
	                </span>
                    <input type="search" placeholder="Filtrar lista de grupos"
                           ng-model="permissionGroupFilter" class="form-control">
                	</div>
				</div>
				<div class="panel-heading">Grupos de Permissões:</div>
				<div class="panel-body">
					<div class="form-group col-sm-12">
						<div class="col-sm-1" ng-hide="true"><input type="checkbox" ng-model="selectedAllPermissionGroup" ng-click="checkAllPermissionGroup()" class="form-control" /></div>
						<label class="col-sm-6 control-label"><a href ng-click="orderPermissionGroup()">Nome</a></label>
						<label class="col-sm-4 control-label">Ações</label>
					</div>
					<div class="form-group col-sm-12" ng-repeat="group in listGroup | filter:permissionGroupFilter" ng-model="items">
						<div class="col-sm-1" ng-hide="true">
							<input type="checkbox" value="||group.id||" ng-model='group.selected' class="form-control" />
						</div>
						<div class="col-sm-6">
							@{{group.name}}
						</div>
						@can("permission.group.update")
						<div class="col-sm-2">
							<button class="btn btn-primary" ng-click="edit(group)">editar</button>
						</div>
						@endcan
						@can("permission.group.delete")
						<div class="col-sm-2">
							<button class="btn btn-danger" ng-click="del(group)">excluir</button>
						</div>
						@endcan
					</div>
					<div class="col-sm-12" ng-hide="true">
						<div class="col-sm-1">
							<input type="checkbox" ng-model="selectedAllPermissionGroup" ng-click="checkAllPermissionGroup()" class="form-control" />
						</div>
						<div class="col-sm-4">
							<button class="btn btn-danger" ng-click="delSelected()">Remover todos selecionados</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="input-group">
	                <span class="input-group-addon">
	                    <i class="glyphicon glyphicon-search"></i>
	                </span>
	                    <input type="search" placeholder="Filtrar permissões"
	                           ng-model="permissionFilter" class="form-control">
	                </div>
                </div>
				<div class="panel-heading">Permissões:</div>
				<div class="panel-body">
					<div class="form-group col-sm-12">
						<div class="col-sm-1"><input type="checkbox" ng-model="selectedAllPermission" ng-click="checkAllPermission()" /></div>
						<div class="col-sm-3">
							Selecionar tudo
						</div>
						<div class="col-sm-1">
							<input type="checkbox" ng-model="keepSelectedPermission" />
						</div>
						<div class="col-sm-7">
							Manter itens selecionados quando usar filtrar
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-1"></div>
						<label class="col-sm-7 control-label"><a href ng-click="orderPermission()">Nome</a></label>
					</div>
					<div class="form-group col-sm-12" ng-repeat="permission in listPermission | filter:permissionFilter" ng-model="items">
						<div class="col-sm-1">
							<input type="checkbox" value="||permission.id||" ng-model='permission.selected' />
						</div>
						<div class="col-sm-8">
							@{{permission.readable_name}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
