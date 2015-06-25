@extends('app')

@section('content')
<script>
	var _url="{{ preg_replace('#^https?://([^/])+#', '',route('admin.permission.show.user',$user->id)) }}";
	var _user=<?php echo $user; ?>;
	var _permission=<?php echo $permission; ?>;
	var _session=<?php echo $session; ?>;

</script>
<div id="result"></div>
<div class="container-fluid hidden startHidden">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Permissões de {{ $user->name }} [{{ $user->email }}]</div>
				<div class="panel-body" ng-controller="appPermissionUserController">
					<div class="panel panel-default">
						<div class="panel-body cloneButtons">
							<div class="col-sm-12">
								<button type="button" class="btn btn-primary" ng-click="save(user)">Salvar</button>
							</div>
						</div>
					</div>
					<input type="hidden" ng-model='user.selected' />
					<div class="col-sm-6">
						@include('permission::partials.sessions')
                    </div>
                    <div class="col-sm-6">
                        @include('permission::partials.permissions')
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
$( ".cloneButtons" ).clone().prependTo( "#divSaveBottom" );
</script>
@endsection
