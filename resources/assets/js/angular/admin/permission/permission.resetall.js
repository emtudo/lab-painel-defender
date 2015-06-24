app.controller('appPermissionController', ['$scope', '$http', '$filter', function(scope, http, filter) {
	scope.listPermission=_permission;
	scope.listSession=_session;
	scope.listUser=_user;
	scope.resetPermissions=false;
	scope.reverseUser = true;
	scope.reversePermission = true;
	scope.reverseSession = true;
	scope.personDetails=function(person){
		scope.view=angular.copy(person);
	};
	scope.showUrl=function(url,id){
		location.href=url+'/'+id;
	};
	scope.orderUser=function(property)
	{
		scope.listUser = filter('orderBy')(scope.listUser,property,scope.reverseUser);
		scope.reverseUser = !scope.reverseUser;
	};
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
			if (scope.resetPermissions)
				reset='yes';
			else
				reset='no';
			var dataObj = {
				'userIds' 		: usersIds,
				'permissionIds' : permissionsIds,
				'sessionIds' 	: sessionsIds,
				'reset'			: reset
			};
			var config = {
				'headers': {
					'X-CSRF-TOKEN': _token,
					'X-XSRF-TOKEN': _token
				}
			};
			http.post(_url,dataObj,config).success(function(data){
				scope.selectedAllUser=false;
				scope.selectedAllPermission=false;
				scope.selectedAllSession=false;
				scope.checkAllUser();
				scope.checkAllPermission();
				scope.checkAllSession();
			    angular.forEach(data, function (i) {
				    angular.forEach(scope.listUser, function (item) {
				    	if (i==item.id) {
					  		var index = scope.listUser.indexOf(item);
					  		scope.listUser.splice(index,1);
				    	}
				    });
			    });
				showSuccess('Permissões salvas com sucesso');
				_token=data._token;
			}). error(function(data, status, headers, config) {
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
	    angular.forEach(scope.listUser, function (item) {
	    	if (item.selected) {
    			usersIds.push(item.id);
	    	}
	    });
		if (!usersIds[0]) {
			showWarning('Você não selecionou nenhum usuário.');
			abort();
		}
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
	scope.checkAllUser = function () {
	    if (scope.selectedAllUser) {
	        scope.selectedAllUser = true;
	    } else {
	        scope.selectedAllUser = false;
	    }
	    if (!scope.keepSelectedUser)
		    angular.forEach(scope.listUser, function (item) {
		        item.selected = false;
		    });
	    angular.forEach(filter('filter')(scope.listUser, scope.user), function (item) {
	        item.selected = scope.selectedAllUser;
	    });
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
