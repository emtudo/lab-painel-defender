@extends('app')

@section('content')
<script>
	var _url="{{ preg_replace('#^https?://([^/])+#', '',route('admin.permission.resetall')) }}";
	var _user=<?php echo $user; ?>;
	var _permission=<?php echo $permission; ?>;
	var _session=<?php echo $session; ?>;

</script>
<div class="container-fluid hidden startHidden">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Permissões de {{ $user->name }} [{{ $user->email }}]</div>
				<div class="panel-body" ng-controller="appPermissionUserController">
					<div class="panel panel-default">
						<div class="panel-body cloneButtons">
							<div class="col-sm-12">
								<button type="button" class="btn btn-primary" ng-click="save()">Salvar</button>
							</div>
						</div>
					</div>
					<input type="hidden" ng-model='user.selected' />
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">Acesso total a sessões</div>
							<div class="panel-body">
								<div class="col-sm-12">
									<input type="search" placeholder="Filtrar sessões" ng-model="session" class="form-control">
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllSession" ng-click="checkAllSession()" class=" form-control" /><br>
									</div>
									<div class="col-sm-2">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedSession" class="form-control" />
									</div>
									<div class="col-sm-6">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
								<div class="row  bg-info">
									<div class="col-sm-10 col-offset-2"><a href ng-click="orderSession('name')">Ordernar</a></div>
								</div>
								<div ng-repeat="session in listSession | filter:session">
									<div class="row">
										<div class="col-sm-2"><input type="checkbox" value="@{{session.id}}" ng-model='session.selected' class="form-control"/></div>
										<div class="col-sm-10">@{{session.name}}</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllSession" ng-click="checkAllSession()" class=" form-control" /><br>
									</div>
									<div class="col-sm-2">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedSession" class="form-control" />
									</div>
									<div class="col-sm-6">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">Permissões</div>
							<div class="panel-body">
								<div class="col-sm-12">
									<input type="search" placeholder="Filtrar permissões" ng-model="permission" class="form-control">
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllPermission" ng-click="checkAllPermission()" class=" form-control" /><br>
									</div>
									<div class="col-sm-2">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedPermission" class="form-control" />
									</div>
									<div class="col-sm-6">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
								<div class="row bg-info">
									<div class="col-sm-10 col-offset-2"><a href ng-click="orderPermission('readable_name')">Ordernar</a></div>
								</div>
								<div ng-repeat="permission in listPermission | filter:permission">
									<div class="row">
										<div class="col-sm-2"><input type="checkbox" value="@{{permission.id}}" ng-model='permission.selected' class="form-control"/></div>
										<div class="col-sm-10">@{{permission.readable_name}}</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllPermission" ng-click="checkAllPermission()" class=" form-control" /><br>
									</div>
									<div class="col-sm-2">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedPermission" class="form-control" />
									</div>
									<div class="col-sm-6">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default" id="divSaveBottom"></div>
			</div>
		</div>
	</div>
</div>
<script>
$( ".cloneButtons" ).clone().prependTo( "#divSaveBottom" );
</script>
@endsection
