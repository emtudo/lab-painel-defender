@extends('app')

@section('content')
<script>
	var _url="{{ preg_replace('#^https?://([^/])+#', '',route('admin.permission.resetall')) }}";
	var _user=<?php echo $user; ?>;

	var _permission=<?php echo $permission; ?>;
	var _session=<?php echo $session; ?>;

</script>
<div id="result"></div>
<div class="container-fluid hidden startHidden" ng-controller="appPermissionController">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Alterar permissões de múltiplos usuários simultaneamente!</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-body cloneButtons">
							<div class="row">
								<div class="col-sm-2">
									<button type="button" class="btn btn-primary" ng-click="save()">Salvar tudo</button>
								</div>
								<div class="col-sm-1">
									<input type="checkbox" ng-model="resetPermissions" class="form-control" />
								</div>
								<div class="col-sm-4">
									Apagar as permissões existens
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">Usuários:</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-9">
										<input type="search" placeholder="Filtrar usuários" ng-model="user" class="form-control">
									</div>
									<div class="col-sm-3">
										Total: @{{resultUser.length}}
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllUser" ng-click="checkAllUser()" class=" form-control" />
									</div>
									<div class="col-sm-2">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedUser" class="form-control" />
									</div>
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
								<div class="row"><br></div>
								<div class="row bg-info">
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><a href ng-click="orderUser('Usuario')">Usuário</a></div>
									<div class="col-sm-4"><a href ng-click="orderUser('Nome')">Nome</a></div>
									<div class="col-sm-2">Ação</div>
								</div>
								<div class="row"><br></div>
								<div ng-repeat="user in listUser | filter:user as resultUser">
									<div class="row">
										<div class="col-sm-2"><input type="checkbox" value="@{{user.id}}" ng-model='user.selected' class="form-control"/></div>
										<div class="col-sm-4"><a href ng-click="personDetails(user.contato)" data-toggle="modal" data-target="#modelPersonDetalhe">@{{user.name}}</a></div>
										<div class="col-sm-4"><a href ng-click="personDetails(user.contato)" data-toggle="modal" data-target="#modelPersonDetalhe">@{{user.name}}</a></div>
										<div class="col-sm-2"><a href ng-click="showUrl('{{ route('admin.permission.show.user','') }}',user.id)" class="btn btn-xs btn-info">Editar</a></div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllUser" ng-click="checkAllUser()" class=" form-control" />
									</div>
									<div class="col-sm-3">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedUser" class="form-control" />
									</div>
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">Acesso total a sessões</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-9">
										<input type="search" placeholder="Filtrar sessões" ng-model="session" class="form-control">
									</div>
									<div class="col-sm-3">
										Total: @{{resultSession.length}}
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllSession" ng-click="checkAllSession()" class=" form-control" />
									</div>
									<div class="col-sm-3">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedSession" class="form-control" />
									</div>
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
								<div class="row bg-info">
									<div class="col-sm-2 col-sm-offset-2"><a href ng-click="orderSession('name')">Ordernar</a></div>
								</div>
								<div ng-repeat="session in listSession | filter:session as resultSession">
									<div class="row">
										<div class="col-sm-2"><input type="checkbox" value="@{{session.id}}" ng-model='session.selected' class="form-control"/></div>
										<div class="col-sm-10">@{{session.name}}</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllSession" ng-click="checkAllSession()" class=" form-control" />
									</div>
									<div class="col-sm-3">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedSession" class="form-control" />
									</div>
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">Permissões</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-9">
										<input type="search" placeholder="Filtrar permissões" ng-model="permission" class="form-control">
									</div>
									<div class="col-sm-3">
										Total: @{{resultPermission.length}}
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
										<input type="checkbox" ng-model="selectedAllPermission" ng-click="checkAllPermission()" class=" form-control" /><br>
									</div>
									<div class="col-sm-3">
										Selecionar tudo
									</div>
									<div class="col-sm-2">
										<input type="checkbox" ng-model="keepSelectedPermission" class="form-control" />
									</div>
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
								<div class="row bg-info">
									<div class="col-sm-10 col-sm-offset-2"><a href ng-click="orderPermission('readable_name')">Ordernar</a></div>
								</div>
								<div ng-repeat="permission in listPermission | filter:permission as resultPermission">
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
									<div class="col-sm-5">
										Manter itens selecionados quando usar filtrar
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12"></div>
				<div class="panel panel-default" id="divSaveBottom"></div>
			</div>
		</div>
	</div>
	@include("person::details")
</div>
<script>
$( ".cloneButtons" ).clone().prependTo( "#divSaveBottom" );
</script>
@endsection
