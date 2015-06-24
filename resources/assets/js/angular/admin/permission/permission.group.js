app.controller('appPermissionGroupController', ['$scope', '$http', '$filter', function(scope, http, filter) {
	scope.group={};
	scope.permission={};
	scope.listGroup=_permissionGroup;
	scope.listPermission=_permission;
	scope.reverseGroup=true;
	scope.reversePermission=true;
	scope.selectedAllPermissionGroup = false;
	scope.orderPermissionGroup=function()
	{
		scope.listGroup = filter('orderBy')(scope.listGroup,'name',scope.reverseGroup);
		scope.reverseGroup = !scope.reverseGroup;
	};
	scope.orderPermission=function()
	{
		scope.listPermission = filter('orderBy')(scope.listPermission,'readable_name',scope.reversePermission);
		scope.reversePermission = !scope.reversePermission;
	};
	scope.save=function(group){
		if (group.id!=undefined) {
			var _method=http.put;
			var _urlSave=_urlBase+'admin/permission/group/'+group.id;
		} else {
			var _method=http.post;
			var _urlSave=_urlBase+'admin/permission/group';
		}
		permissionIds = [];
	    angular.forEach(scope.listPermission, function (item) {
	    	if (item.selected)
	        	permissionIds.push(item.id);
	    });
		var dataObj = {
			'group'			: group,
			'permissionIds'	: permissionIds
		}
		var config = {
			'headers': {
				'X-CSRF-TOKEN': _token,
				'X-XSRF-TOKEN': _token
			}
		};
		_method(_urlSave,dataObj,config).success(function(data){
			swal(data.message);
			if (group.id==undefined)
				scope.listGroup.push(data.group);
			scope.group={};
			_token=data._token;
			scope.selectedAllPermission=false;
			scope.checkAllPermission();
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
	scope.edit=function(group)
	{
		scope.group = group;
		location.href="#addPemission";
		scope.selectedAllPermission=false;
		scope.checkAllPermission();
		http.get(_urlBase+'admin/permission/group/'+group.id+'/permissions').success(function(data){
		    angular.forEach(data, function (i) {
			    angular.forEach(scope.listPermission, function (item) {
			    	if (i.id==item.id)
			        	item.selected = true;
			    });
		    });
		});
	};
	scope.del=function(group)
	{
		swal({  title: 'Tem certeza que deseja excluir: '+group.name+'?',
				text: 'Você não será capaz de recuperar novamente este cadastro!',
				type: "warning",
				showCancelButton: true,
				cancelButtonText: "Cancelar",
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Sim, tenho certeza",
				closeOnConfirm: true
		}, function(){
			var config = {
				'headers': {
					'X-CSRF-TOKEN': _token,
					'X-XSRF-TOKEN': _token
				}
			};
			http.delete(_urlBase+'admin/permission/group/'+group.id,config).success(function(data){
				_token=data._token;
				var index=scope.listGroup.indexOf(group);
				scope.listGroup.splice(index,1);
				scope.group={};
				showSuccess(data.message);
			}).error(function(data, status, headers, config) {
				$("#result").html(data);
				abort();
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
		});
	};
	scope.checkAllPermissionGroup = function () {
	    if (scope.selectedAllPermissionGroup) {
	        scope.selectedAllPermissionGroup = true;
	    } else {
	        scope.selectedAllPermissionGroup = false;
	    }
	    angular.forEach(scope.listGroup, function (item) {
	        item.selected = scope.selectedAllPermissionGroup;
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
	    angular.forEach(filter('filter')(scope.listPermission, scope.permissionFilter), function (item) {
	        item.selected = scope.selectedAllPermission;
	    });
	};
}]);
