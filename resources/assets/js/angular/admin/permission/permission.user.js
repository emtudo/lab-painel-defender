app.controller('appPermissionUserController', ['$scope', '$http', '$filter', function(scope, http, filter) {
	scope.listPermission=_permission;
	scope.listSession=_session;
	scope.listUser=_user;
	scope.resetPermissions=false;
	scope.reverseUser = true;
	scope.reversePermission = true;
	scope.reverseSession = true;
	scope.listUser.selected=true;
    angular.forEach(scope.listSession, function (rule) {
	    angular.forEach(scope.listUser.sessions, function (user) {
	    	if (rule.id==user.role_id) {
		        rule.selected = true;
	    	}
	    });
    });
    angular.forEach(scope.listPermission, function (permission) {
	    angular.forEach(scope.listUser.permissions, function (user) {
	    	if (permission.id==user.role_id) {
		        permission.selected = true;
	    	}
	    });
    });
	scope.orderPermission=function(property)
	{
		scope.listPermission = filter('orderBy')(scope.listPermission,property,scope.reversePermission);
		scope.reversePermission = !scope.reversePermission;
	};
	scope.orderSession=function(property)
	{
		scope.listSession = filter('orderBy')(scope.listSession,property,scope.reverseSession);
		scope.reverseSession = !scope.reverseSession;
	};
	scope.save=function(){
		var _fContinue=function() {
			var dataObj = {
				'userIds' 		: usersIds,
				'permissionIds' : permissionsIds,
				'sessionIds' 	: sessionsIds,
				'reset'			: 'yes'
			};
			var config = {
				'headers': {
					'X-CSRF-TOKEN': _token,
					'X-XSRF-TOKEN': _token
				}
			};
			http.put(_url,dataObj,config).success(function(data){
				showSuccess('Permissões salvas com sucesso');
				_token=data._token;
			}).error(function(data, status, headers, config) {
				$("#result").html(data);
				if(typeof data === 'string' ) {
					showError(data);
				} else {
					var r = '';
					angular.forEach(data, function(value) {
						r=r+value+"\n";
					}, r);
					showError(r);
				};
			});
		};
		usersIds=[];
		usersIds.push(_user.id);
		permissionsIds=[];
	    angular.forEach(scope.listPermission, function (item) {
	    	if (item.selected) {
	    		if (item.id) {
	    			permissionsIds.push(item.id);
	    		}
	    	}
	    });
		sessionsIds=[];
	    angular.forEach(scope.listSession, function (item) {
	    	if (item.selected) {
	    		if (item.id) {
	    			sessionsIds.push(item.id);
	    		}
	    	}
	    });
		if (!permissionsIds[0] && !sessionsIds[0]) {
			if (!scope.deletePermission) {
				swal({  title: 'Atenção!',
						text: 'Nenhuma permissão ou grupo selecionado, se continuar todas as permissões serão excluída.\n\nDeseja continuar?',
						type: "warning",
						showCancelButton: true,
						cancelButtonText: "Cancelar",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim, tenho certeza",
						closeOnConfirm: true
				}, function(){
					scope.resetPermissions=true;
					_fContinue();
				});
				abort();
			} else
				_fContinue();
		} else
			_fContinue();
	};
	scope.checkAllPermission = function () {
	    if (scope.selectedAllPermission) {
	        scope.selectedAllPermission = true;
	    } else {
	        scope.selectedAllPermission = false;
	    }
	    if (!scope.keepSelectedPermission)
		    angular.forEach(scope.listPermission, function (item) {
		        item.selected = false;
		    });
	    angular.forEach(filter('filter')(scope.listPermission, scope.permission), function (item) {
	        item.selected = scope.selectedAllPermission;
	    });
	};
	scope.checkAllSession = function () {
	    if (scope.selectedAllSession) {
	        scope.selectedAllSession = true;
	    } else {
	        scope.selectedAllSession = false;
	    }
	    if (!scope.keepSelectedUser)
		    angular.forEach(scope.listSession, function (item) {
		        item.selected = false;
		    });
	    angular.forEach(filter('filter')(scope.listSession, scope.session), function (item) {
	        item.selected = scope.selectedAllSession;
	    });
	};
}]);
