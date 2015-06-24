@extends('app')

@section('content')
<script>
</script>

<div class="container-fluid" ng-controller="permissionNewController">
	<div class="row" ng-controller="groupController">
		<div class="col-sm-10 col-md-offset-1">
			<div class="panel panel-default" ng-hide="!permission.id">
				<div class="panel-heading"><section id="addPemission">Permissão</section></div>
				<div class="panel-body">
					<input type="hidden" name="addIdGroup" ng-model="permission.id">
					<div class="form-group">
						<label class="col-sm-1 control-label">Nome</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" ng-model="permission.name" maxlength="45" placeholder="Nome">
						</div>
						<div class="col-sm-1 text-right pull-right" ng-hide="permission.edit">
							<button type="button" type="submit" class="btn btn-primary" style="margin-right: 15px;" ng-click="save('no')">
								Salvar
							</button>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" ng-model="permission.selectSelected">
			<div class="panel panel-default" ng-hide="permission.selectSelected=='selected'">
				<div class="panel-heading"><input type="text" ng-model="permissionFilter" class="form-control" placeholder="Filtrar lista de grupos"></div>
				<div class="panel-heading">Grupos de Permissões:</div>
				<div class="panel-body">
					<div class="form-group col-sm-12">
						<div class="col-sm-1" ng-hide="true"><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" class="form-control" /></div>
						<label class="col-sm-3 control-label"><a href ng-click="order(['name','status'])">Nome</a></label>
						<label class="col-sm-6 control-label">Ações</label>
					</div>
					<div class="form-group col-sm-12" ng-repeat="permission in listPermission | filter:permissionFilter" ng-model="items">
						<div class="col-sm-1" ng-hide="true">
							<input type="checkbox" value="||permission.id||" ng-model='permission.Selected' class="form-control" />
						</div>
						<div class="col-sm-3">
							||permission.name||
						</div>
						<div class="col-sm-1" ng-hide="true">
							<button class="btn btn-danger" ng-click="del(permission)">excluir</button>
						</div>
						<div class="col-sm-1">
							<button class="btn btn-primary" ng-click="edit(permission)">editar</button>
						</div>
					</div>
					<div class="col-sm-12" ng-hide="true">
						<div class="col-sm-1">
							<input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" class="form-control" />
						</div>
						<div class="col-sm-4">
							<button class="btn btn-danger" ng-click="delSelected()">Remover todos selecionados</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




